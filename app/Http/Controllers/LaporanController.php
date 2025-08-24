<?php

namespace App\Http\Controllers;

use App\Models\Kelas; // <-- Ubah dari Sarpras ke Kelas
use App\Models\Sarpras;
use Illuminate\Http\Request;
use App\Exports\SarprasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
     * Menghasilkan dan mengunduh laporan dalam format PDF.
     */
    public function exportPdf()
    {
        // Ambil semua kelas yang memiliki sarpras, beserta data sarprasnya
        $kelas = Kelas::whereHas('sarpras')->with('sarpras')->get();
        
        $pdf = Pdf::loadView('laporan.pdf_view', ['semua_kelas' => $kelas]);
        return $pdf->download('laporan-inventaris-per-kelas.pdf');
    }
}