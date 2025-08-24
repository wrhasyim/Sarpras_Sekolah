<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Log;
use App\Models\Sarpras;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk kartu statistik
        $totalSarpras = Sarpras::count();
        $totalLokasi = Kelas::count();
        $totalUser = User::count();

        // Data untuk Pie Chart Kondisi Barang
        $kondisiCounts = Sarpras::select('kondisi', DB::raw('count(*) as total'))
            ->groupBy('kondisi')
            ->pluck('total', 'kondisi');

        $kondisiLabels = $kondisiCounts->keys();
        $kondisiData = $kondisiCounts->values();

        // Data untuk Bar Chart Top 5 Lokasi by Item Count
        $lokasiCounts = Sarpras::select('kelas_id', DB::raw('sum(jumlah) as total_jumlah'))
            ->groupBy('kelas_id')
            ->orderBy('total_jumlah', 'desc')
            ->take(5)
            ->with('kelas')
            ->get();

        $lokasiLabels = $lokasiCounts->map(fn($item) => $item->kelas->nama_kelas);
        $lokasiData = $lokasiCounts->pluck('total_jumlah');

        // Data untuk tabel
        $sarprasTerbaru = Sarpras::with('kelas')->latest()->take(5)->get();
        $logTerbaru = Log::with('user')->latest()->take(5)->get();

        return view('dashboard.dashboard', compact(
            'totalSarpras',
            'totalLokasi',
            'totalUser',
            'kondisiLabels',
            'kondisiData',
            'lokasiLabels',
            'lokasiData',
            'sarprasTerbaru',
            'logTerbaru'
        ));
    }
}