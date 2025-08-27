<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;
    protected $table = 'sarpras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_barang', // <-- TAMBAHKAN BARIS INI
        'nama_barang',
        'kelas_id',
        'jumlah',
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'keterangan',
    ];

    /**
     * Get the kelas that owns the Sarpras
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}