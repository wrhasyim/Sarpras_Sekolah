<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Sarpras;
use Illuminate\Support\Facades\Hash;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat Kelas
        $kelas1 = Kelas::create(['nama_kelas' => '10-A']);
        $kelas2 = Kelas::create(['nama_kelas' => '10-B']);
        $kelas3 = Kelas::create(['nama_kelas' => '11-A']);
        $kelas4 = Kelas::create(['nama_kelas' => '11-B']);
        $kelas5 = Kelas::create(['nama_kelas' => 'Ruang Guru']);

        // Membuat Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Tata Usaha',
            'email' => 'tu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'tu',
        ]);

        User::create([
            'name' => 'Wali Kelas 10-A',
            'email' => 'walikelas10a@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'wali_kelas',
            'kelas_id' => $kelas1->id,
        ]);

        // === PERBAIKAN UTAMA DI BAGIAN SARPRAS ===
        Sarpras::create([
            'kode_barang' => 'KRS-10A-001',
            'nama_barang' => 'Kursi Siswa',
            'jumlah' => 30,
            'kondisi_baik' => 28,
            'kondisi_rusak_ringan' => 2,
            'kondisi_rusak_berat' => 0,
            'kelas_id' => $kelas1->id,
            'keterangan' => 'Kursi kayu',
        ]);

        Sarpras::create([
            'kode_barang' => 'MJA-10A-001',
            'nama_barang' => 'Meja Siswa',
            'jumlah' => 15,
            'kondisi_baik' => 15,
            'kondisi_rusak_ringan' => 0,
            'kondisi_rusak_berat' => 0,
            'kelas_id' => $kelas1->id,
            'keterangan' => 'Meja untuk 2 siswa',
        ]);

        Sarpras::create([
            'kode_barang' => 'LMP-RG-001',
            'nama_barang' => 'Lampu Neon',
            'jumlah' => 4,
            'kondisi_baik' => 3,
            'kondisi_rusak_ringan' => 1,
            'kondisi_rusak_berat' => 0,
            'kelas_id' => $kelas5->id,
            'keterangan' => 'Satu lampu berkedip',
        ]);
    }
}