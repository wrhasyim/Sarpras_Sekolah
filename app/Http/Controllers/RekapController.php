<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RekapBulanan;
use App\Models\Sarpras; // PASTIKAN BARIS INI ADA DAN TIDAK DIHAPUS
use Illuminate\Http\Request;
use Carbon\Carbon;

class RekapController extends Controller
{
    /**
     * Menampilkan halaman utama rekap dengan filter.
     */
    public function index(Request $request)
    {
        $filterBulan = $request->input('bulan', now()->month);
        $filterTahun = $request->input('tahun', now()->year);
        $filterKelas = $request->input('kelas_id');

        $rekapsQuery = RekapBulanan::with(['sarpras', 'kelas'])
            ->where('bulan', $filterBulan)
            ->where('tahun', $filterTahun);

        if ($filterKelas) {
            $rekapsQuery->where('kelas_id', $filterKelas);
        }

        $rekaps = $rekapsQuery->get()->groupBy('kelas.nama_kelas');

        $prevBulan = Carbon::create($filterTahun, $filterBulan)->subMonth();
        $rekapsSebelumnya = RekapBulanan::where('bulan', $prevBulan->month)
            ->where('tahun', $prevBulan->year)
            ->get()
            ->keyBy(function ($item) {
                return $item->sarpras_id . '-' . $item->kelas_id;
            });

        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        return view('rekap.index', compact('rekaps', 'rekapsSebelumnya', 'daftarKelas', 'filterBulan', 'filterTahun', 'filterKelas', 'prevBulan'));
    }

    /**
     * Menghasilkan rekap data untuk bulan dan tahun yang dipilih.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2020',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Kode ini akan berjalan dengan benar karena Sarpras sudah di-import
        $currentSarpras = Sarpras::whereNotNull('kelas_id')->get();

        if ($currentSarpras->isEmpty()) {
            return back()->with('error', 'Tidak ada data sarpras yang bisa direkap. Pastikan sarpras sudah dialokasikan ke kelas.');
        }

        $rekapData = [];
        foreach ($currentSarpras as $sarpras) {
            $rekapData[] = [
                'sarpras_id' => $sarpras->id,
                'kelas_id' => $sarpras->kelas_id,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jumlah' => $sarpras->jumlah ?? 0,
                'kondisi_baik' => $sarpras->kondisi_baik ?? 0,
                'kondisi_rusak_ringan' => $sarpras->kondisi_rusak_ringan ?? 0,
                'kondisi_rusak_berat' => $sarpras->kondisi_rusak_berat ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        RekapBulanan::upsert(
            $rekapData,
            ['sarpras_id', 'kelas_id', 'bulan', 'tahun'],
            ['jumlah', 'kondisi_baik', 'kondisi_rusak_ringan', 'kondisi_rusak_berat', 'updated_at']
        );

        return redirect()->route('rekap.index', ['bulan' => $bulan, 'tahun' => $tahun])
                         ->with('success', "Rekap untuk bulan $bulan tahun $tahun berhasil dibuat/diperbarui.");
    }
}