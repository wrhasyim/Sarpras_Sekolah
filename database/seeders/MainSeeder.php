<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Kelas
        DB::table('kelas')->insert([
            ['nama_kelas' => 'Kelas 10-A'],
            ['nama_kelas' => 'Kelas 10-B'],
            ['nama_kelas' => 'Kelas 11-A'],
            ['nama_kelas' => 'Kelas 11-B'],
            ['nama_kelas' => 'Ruang Guru'],
            ['nama_kelas' => 'Perpustakaan'],
        ]);

        // Buat Users
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin Utama',
                'email' => 'admin@sarpras.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'kelas_id' => null,
            ],
            // Tata Usaha
            [
                'name' => 'Staf Tata Usaha',
                'email' => 'tu@sarpras.com',
                'password' => Hash::make('password'),
                'role' => 'tu',
                'kelas_id' => null,
            ],
            // Wali Kelas
            [
                'name' => 'Budi (Wali 10-A)',
                'email' => 'walikelas@sarpras.com',
                'password' => Hash::make('password'),
                'role' => 'wali_kelas',
                'kelas_id' => 1, // Wali Kelas 10-A
            ],
        ]);
        
        // Buat contoh Sarpras
        DB::table('sarpras')->insert([
            [
                'kode_barang' => 'KRS-10A-001',
                'nama_barang' => 'Kursi Siswa',
                'jumlah' => 30,
                'kondisi' => 'baik',
                'kelas_id' => 1,
                'keterangan' => 'Kursi kayu',
            ],
            [
                'kode_barang' => 'MJA-10A-001',
                'nama_barang' => 'Meja Siswa',
                'jumlah' => 15,
                'kondisi' => 'baik',
                'kelas_id' => 1,
                'keterangan' => 'Meja untuk 2 siswa',
            ],
            [
                'kode_barang' => 'LMP-RG-001',
                'nama_barang' => 'Lampu Neon',
                'jumlah' => 4,
                'kondisi' => 'rusak_ringan',
                'kelas_id' => 5, // Ruang Guru
                'keterangan' => 'Satu lampu berkedip',
            ],
        ]);
    }
}