<?php

namespace App\Http\Controllers;

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
        $sarpras = Sarpras::with('kelas')->get();
        $pdf = Pdf::loadView('laporan.pdf_view', ['sarpras' => $sarpras]);
        return $pdf->download('laporan-sarpras.pdf');
    }
}