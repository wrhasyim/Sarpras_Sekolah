<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RekapBulanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $data = [
            'kelasData' => $kelasData,
            'latestRekap' => $latestRekap,
            'selectedRekap' => $selectedRekap
        ];

        // Diubah dari 'laporan.pdf_view_basic' menjadi 'laporan.pdf_view'
        $pdf = Pdf::loadView('laporan.pdf_view', compact('data'));

        return $pdf->download('laporan-sarpras.pdf');
    }
}