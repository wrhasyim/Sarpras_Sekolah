// database/migrations/xxxx_xx_xx_xxxxxx_create_rekap_bulanan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekap_bulanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sarpras_id')->constrained('sarpras')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('jumlah');
            $table->integer('kondisi_baik');
            $table->integer('kondisi_rusak_ringan');
            $table->integer('kondisi_rusak_berat');
            $table->timestamps();

            // Mencegah duplikasi data untuk barang yang sama di kelas yang sama pada bulan dan tahun yang sama
            $table->unique(['sarpras_id', 'kelas_id', 'bulan', 'tahun'], 'rekap_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_bulanan');
    }
};