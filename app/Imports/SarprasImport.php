<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Sarpras;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SarprasImport implements ToModel, WithHeadingRow, WithUpserts, WithValidation
{
    private $kelasMapping;

    public function __construct()
    {
        // Membuat mapping dari nama kelas ke ID untuk efisiensi
        $this->kelasMapping = Kelas::pluck('id', 'nama_kelas');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Mencari ID kelas berdasarkan nama kelas dari file Excel
        $kelasId = $this->kelasMapping->get($row['lokasi']);

        // Menghitung jumlah total dari semua kondisi
        $jumlahTotal = ($row['kondisi_baik'] ?? 0) + ($row['rusak_ringan'] ?? 0) + ($row['rusak_berat'] ?? 0);

        return new Sarpras([
            'kode_barang'          => $row['kode_barang'],
            'nama_barang'          => $row['nama_barang'],
            'jumlah'               => $jumlahTotal, // Jumlah total dihitung otomatis
            'kondisi_baik'         => $row['kondisi_baik'] ?? 0,
            'kondisi_rusak_ringan' => $row['rusak_ringan'] ?? 0,
            'kondisi_rusak_berat'  => $row['rusak_berat'] ?? 0,
            'kelas_id'             => $kelasId,
        ]);
    }

    /**
     * Tentukan kolom unik untuk operasi upsert.
     */
    public function uniqueBy()
    {
        return 'kode_barang';
    }

    /**
     * Aturan validasi untuk setiap baris.
     */
    public function rules(): array
    {
        return [
            // 'kode_barang' harus ada dan berupa teks
            'kode_barang' => 'required|string',

            // 'nama_barang' harus ada dan berupa teks
            'nama_barang' => 'required|string',

            // 'lokasi' harus ada dan namanya harus terdaftar di tabel kelas
            'lokasi' => 'required|string|exists:kelas,nama_kelas',

            // Kolom kondisi boleh kosong, tapi jika diisi harus berupa angka
            'kondisi_baik' => 'nullable|integer',
            'rusak_ringan' => 'nullable|integer',
            'rusak_berat' => 'nullable|integer',
        ];
    }

    /**
     * Pesan error kustom untuk validasi.
     */
    public function customValidationMessages()
    {
        return [
            'lokasi.exists' => 'Nama lokasi/kelas tidak ditemukan di database.',
        ];
    }
}