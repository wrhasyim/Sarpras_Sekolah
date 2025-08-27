<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\User;
use App\Models\Kelas; // <-- TAMBAHKAN MODEL KELAS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSarpras = Sarpras::count();
        $totalUser = User::count();
        $totalLokasi = Kelas::count(); // <-- KEMBALIKAN PERHITUNGAN INI

        // Mengambil total dari setiap kolom kondisi secara terpisah
        $kondisiCounts = [
            'Baik' => Sarpras::sum('kondisi_baik'),
            'Rusak Ringan' => Sarpras::sum('kondisi_rusak_ringan'),
            'Rusak Berat' => Sarpras::sum('kondisi_rusak_berat'),
        ];

        $sarprasTerbaru = Sarpras::with('kelas')->latest()->take(5)->get();

        // Kirim semua variabel yang dibutuhkan oleh view
        return view('dashboard.dashboard', compact('totalSarpras', 'totalUser', 'totalLokasi', 'kondisiCounts', 'sarprasTerbaru'));
    }
}