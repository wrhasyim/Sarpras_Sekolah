<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapSarpras extends Model
{
    use HasFactory;

    protected $table = 'rekap_sarpras';

    protected $fillable = [
        'sarpras_id',
        'bulan',
        'tahun',
        'jumlah',
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'keterangan',
    ];

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }
}