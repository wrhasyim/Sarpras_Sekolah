<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBulanan extends Model
{
    use HasFactory;

    protected $table = 'rekap_bulanan';

    protected $fillable = [
        'sarpras_id',
        'kelas_id',
        'bulan',
        'tahun',
        'jumlah',
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
    ];

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}