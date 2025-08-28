<?php

namespace App\Exports;

use App\Models\Sarpras;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SarprasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil semua data sarpras beserta relasi kelasnya
        return Sarpras::with('kelas')->get();
    }

    /**
     * Menentukan judul untuk setiap kolom di file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'kode_barang',
            'nama_barang',
            'lokasi',
            'kondisi_baik',
            'rusak_ringan',
            'rusak_berat',
        ];
    }

    /**
     * Memetakan data dari collection ke format baris yang diinginkan.
     *
     * @param mixed $sarpras
     *
     * @return array
     */
    public function map($sarpras): array
    {
        return [
            $sarpras->kode_barang,
            $sarpras->nama_barang,
            // Mengambil nama kelas dari relasi, atau string kosong jika tidak ada
            $sarpras->kelas->nama_kelas ?? '',
            $sarpras->kondisi_baik,
            $sarpras->kondisi_rusak_ringan,
            $sarpras->kondisi_rusak_berat,
        ];
    }
}