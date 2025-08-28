<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RekapBulanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $latestRekap = RekapBulanan::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->first();
        $kelasData = Kelas::with('sarpras')->has('sarpras')->get();
        $selectedRekap = null;

        if ($latestRekap) {
            $rekapBulan = RekapBulanan::where('bulan', $latestRekap->bulan)
                ->where('tahun', $latestRekap->tahun)
                ->get();

            $selectedRekap = $rekapBulan->mapWithKeys(function ($item) {
                return [$item->sarpras_id => $item];
            });
        }

        return view('laporan.index', compact('kelasData', 'latestRekap', 'selectedRekap'));
    }

    public function exportPdf()
    {
        // 1. Ambil data rekap bulan terbaru
        $latestRekap = RekapBulanan::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->first();

        // Jika tidak ada data rekap sama sekali, hentikan proses
        if (!$latestRekap) {
            return redirect()->back()->with('error', 'Belum ada data rekap yang bisa dicetak.');
        }
        
        // Ambil semua data dari bulan rekap terbaru
        $rekapBulanIni = RekapBulanan::where('bulan', $latestRekap->bulan)
            ->where('tahun', $latestRekap->tahun)
            ->get()
            ->keyBy('sarpras_id'); // Gunakan keyBy untuk mapping

        // 2. Tentukan dan ambil data rekap satu bulan sebelumnya
        $tanggalRekap = Carbon::create($latestRekap->tahun, $latestRekap->bulan, 1);
        $tanggalSebelumnya = $tanggalRekap->subMonth();
        
        $rekapBulanLalu = RekapBulanan::where('bulan', $tanggalSebelumnya->month)
            ->where('tahun', $tanggalSebelumnya->year)
            ->get()
            ->keyBy('sarpras_id'); // Gunakan keyBy untuk mapping

        // 3. Ambil data master sarpras dan kelas
        $kelasData = Kelas::with('sarpras')->has('sarpras')->get();

        $data = [
            'kelasData' => $kelasData,
            'latestRekap' => $latestRekap,
            'rekapBulanIni' => $rekapBulanIni,
            'rekapBulanLalu' => $rekapBulanLalu,
        ];

        $pdf = Pdf::loadView('laporan.pdf_view', compact('data'));

        return $pdf->download('laporan-sarpras-' . $latestRekap->bulan . '-' . $latestRekap->tahun . '.pdf');
    }
}