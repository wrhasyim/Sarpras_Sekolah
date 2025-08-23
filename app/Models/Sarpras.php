<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;
    protected $table = 'sarpras';
    protected $fillable = ['kode_barang', 'nama_barang', 'jumlah', 'kondisi', 'kelas_id', 'keterangan'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}