<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RekapBulanan; // Import model RekapBulanan
use Illuminate\Http\Request;
use App\Exports\SarprasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama untuk menu laporan.
     */
    public function index()
    {
        return view('laporan.index');
    }

    /**
     * Menghasilkan dan mengunduh laporan dalam format Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new SarprasExport, 'laporan-sarpras.xlsx');
    }

    /**
     * Menghasilkan dan mengunduh laporan dalam format PDF dengan perbandingan.
     */
    public function exportPdf()
    {
        // Mengambil rekap terbaru sebagai dasar laporan
        $latestRekap = RekapBulanan::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->first();

        if (!$latestRekap) {
            // Jika tidak ada rekap, buat PDF dari data sarpras saat ini tanpa perbandingan
            $kelas = Kelas::whereHas('sarpras')->with('sarpras')->get();
            $pdf = Pdf::loadView('laporan.pdf_view_basic', ['semua_kelas' => $kelas]);
            return $pdf->download('laporan-inventaris-saat-ini.pdf');
        }

        $filterBulan = $latestRekap->bulan;
        $filterTahun = $latestRekap->tahun;

        // Mengambil data rekap untuk bulan dan tahun terpilih
        $rekaps = RekapBulanan::with(['sarpras', 'kelas'])
            ->where('bulan', $filterBulan)
            ->where('tahun', $filterTahun)
            ->get()
            ->groupBy('kelas.nama_kelas');

        // Mengambil data rekap bulan sebelumnya untuk perbandingan
        $prevBulan = Carbon::create($filterTahun, $filterBulan)->subMonth();
        $rekapsSebelumnya = RekapBulanan::where('bulan', $prevBulan->month)
            ->where('tahun', $prevBulan->year)
            ->get()
            ->keyBy(function ($item) {
                return $item->sarpras_id . '-' . $item->kelas_id;
            });

        $pdf = Pdf::loadView('laporan.pdf_view', [
            'rekaps' => $rekaps,
            'rekapsSebelumnya' => $rekapsSebelumnya,
            'bulan' => $filterBulan,
            'tahun' => $filterTahun,
            'prevBulan' => $prevBulan,
        ]);

        return $pdf->download('laporan-perbandingan-inventaris-' . $filterBulan . '-' . $filterTahun . '.pdf');
    }
}