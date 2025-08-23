<?php

namespace App\Imports;

use App\Models\Sarpras;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SarprasImport implements ToModel, WithHeadingRow, WithUpserts
{
    private $kelasMapping;

    public function __construct()
    {
        // Buat mapping 'nama_kelas' => 'id' untuk efisiensi
        $this->kelasMapping = Kelas::pluck('id', 'nama_kelas');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Cari ID kelas berdasarkan nama, jika tidak ada, lewati baris ini
        $kelasId = $this->kelasMapping->get($row['lokasi_kelas']);
        if (!$kelasId) {
            return null;
        }

        return new Sarpras([
            'kode_barang'   => $row['kode_barang'],
            'nama_barang'   => $row['nama_barang'],
            'jumlah'        => $row['jumlah'],
            'kondisi'       => strtolower(str_replace(' ', '_', $row['kondisi'])),
            'kelas_id'      => $kelasId,
            'keterangan'    => $row['keterangan'] ?? null,
        ]);
    }

    /**
     * Tentukan kolom unik untuk operasi update/insert (upsert).
     *
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'kode_barang';
    }
}