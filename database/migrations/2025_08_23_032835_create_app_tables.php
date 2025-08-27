<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabel Kelas
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->timestamps();
        });

        // Tabel Sarpras (Sarana dan Prasarana)
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique()->nullable();
            $table->string('nama_barang');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null');
            $table->integer('jumlah');
            $table->integer('kondisi_baik');
            $table->integer('kondisi_rusak_ringan');
            $table->integer('kondisi_rusak_berat');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel Log Aktivitas
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('activity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('sarpras');
        Schema::dropIfExists('kelas');
    }
}