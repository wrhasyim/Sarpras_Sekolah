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
        return Sarpras::with('kelas')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Kondisi',
            'Lokasi (Kelas)',
            'Keterangan',
            'Tanggal Ditambahkan',
        ];
    }

    /**
     * @param mixed $sarpras
     *
     * @return array
     */
    public function map($sarpras): array
    {
        return [
            $sarpras->kode_barang,
            $sarpras->nama_barang,
            $sarpras->jumlah,
            ucwords(str_replace('_', ' ', $sarpras->kondisi)),
            $sarpras->kelas->nama_kelas,
            $sarpras->keterangan,
            // Perubahan di baris ini: menggunakan optional() untuk menangani nilai NULL
            optional($sarpras->created_at)->format('d-m-Y'),
        ];
    }
}