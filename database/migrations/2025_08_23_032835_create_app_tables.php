<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Kelas
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->timestamps();
        });

        // Tabel Sarpras
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat']);
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel Logs
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('aktivitas');
            $table->timestamps();
        });

        // Tambah foreign key di tabel users setelah tabel kelas dibuat
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('sarpras');
        Schema::dropIfExists('kelas');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};