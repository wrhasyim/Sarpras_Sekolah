<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;
use App\Models\User;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Sarpras::sum('jumlah');
        $barangBaik = Sarpras::where('kondisi', 'baik')->sum('jumlah');
        $barangRusakRingan = Sarpras::where('kondisi', 'rusak_ringan')->sum('jumlah');
        $barangRusakBerat = Sarpras::where('kondisi', 'rusak_berat')->sum('jumlah');

        return view('dashboard', compact('totalBarang', 'barangBaik', 'barangRusakRingan', 'barangRusakBerat'));
    }
}