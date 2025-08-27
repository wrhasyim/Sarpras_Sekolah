<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekap_sarpras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sarpras_id')->constrained('sarpras')->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('jumlah');
            $table->integer('kondisi_baik');
            $table->integer('kondisi_rusak_ringan');
            $table->integer('kondisi_rusak_berat');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_sarpras');
    }
};