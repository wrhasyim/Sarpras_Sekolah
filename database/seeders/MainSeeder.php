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
        $kelas1 = Kelas::create(['nama_kelas' => 'Ruang A3']);
       $kelas2 = Kelas::create(['nama_kelas' => 'Ruang A4']);
       $kelas3 = Kelas::create(['nama_kelas' => 'Ruang A7']);
       $kelas4 = Kelas::create(['nama_kelas' => 'Ruang A8']);
       $kelas5 = Kelas::create(['nama_kelas' => 'Ruang A13']);
       $kelas6 = Kelas::create(['nama_kelas' => 'Ruang A14']);
       $kelas7 = Kelas::create(['nama_kelas' => 'Ruang B1']);
       $kelas8 = Kelas::create(['nama_kelas' => 'Ruang B2']);
       $kelas9 = Kelas::create(['nama_kelas' => 'Ruang B4']);
       $kelas10 = Kelas::create(['nama_kelas' => 'Ruang B5']);
       $kelas11 = Kelas::create(['nama_kelas' => 'Ruang B7']);
       $kelas12 = Kelas::create(['nama_kelas' => 'Ruang B8']);
       $kelas13 = Kelas::create(['nama_kelas' => 'Ruang B10']);

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

       
    }
}