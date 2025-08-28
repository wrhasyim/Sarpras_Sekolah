<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sarpras;
use Illuminate\Http\Request;
use App\Exports\SarprasExport;
use App\Imports\SarprasImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SarprasController extends Controller
{
    /**
     * Menampilkan daftar sarana prasarana.
     */
    public function index()
    {
        $sarpras = Sarpras::with('kelas')->paginate(10);
        return view('sarpras.index', compact('sarpras'));
    }

    /**
     * Menampilkan form untuk membuat data sarpras baru.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('sarpras.create', compact('kelas'));
    }

    /**
     * Menyimpan data sarpras baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|max:255|unique:sarpras,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak_ringan' => 'required|integer|min:0',
            'kondisi_rusak_berat' => 'required|integer|min:0',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $total_kondisi = $validated['kondisi_baik'] + $validated['kondisi_rusak_ringan'] + $validated['kondisi_rusak_berat'];

        if ($total_kondisi != $validated['jumlah']) {
            return redirect()->back()
                ->withErrors(['jumlah_total' => 'Jumlah total dari semua kondisi (baik, rusak ringan, rusak berat) harus sama dengan Jumlah Total sarpras.'])
                ->withInput();
        }

        Sarpras::create($validated);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data sarpras.
     */
    public function edit(Sarpras $sarpras)
    {
        $kelas = Kelas::all();
        return view('sarpras.edit', compact('sarpras', 'kelas'));
    }

    /**
     * Memperbarui data sarpras di database.
     */
    public function update(Request $request, Sarpras $sarpras)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|max:255|unique:sarpras,kode_barang,' . $sarpras->id,
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak_ringan' => 'required|integer|min:0',
            'kondisi_rusak_berat' => 'required|integer|min:0',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $total_kondisi = $validated['kondisi_baik'] + $validated['kondisi_rusak_ringan'] + $validated['kondisi_rusak_berat'];

        if ($total_kondisi != $validated['jumlah']) {
            return redirect()->back()
                ->withErrors(['jumlah_total' => 'Jumlah total dari semua kondisi harus sama dengan Jumlah Total sarpras.'])
                ->withInput();
        }

        $sarpras->update($validated);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diperbarui.');
    }

    /**
     * Menghapus data sarpras dari database.
     */
    public function destroy(Sarpras $sarpras)
    {
        $sarpras->delete();
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil dihapus.');
    }

    /**
     * Menangani ekspor data sarpras ke file Excel.
     */
    public function export()
    {
        return Excel::download(new SarprasExport, 'sarpras.xlsx');
    }

    /**
     * Menampilkan form untuk impor data.
     */
    public function showImportForm()
    {
        return view('sarpras.import');
    }

    /**
     * Menangani impor data sarpras dari file Excel.
     */
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);

        try {
            Excel::import(new SarprasImport, $request->file('file'));
            return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                // Kumpulkan pesan error untuk setiap baris yang gagal
                $errorMessages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            // Kembalikan ke halaman sebelumnya dengan pesan error yang jelas
            return redirect()->back()->with('error', '<b>Terjadi kesalahan validasi saat impor:</b><br>' . implode('<br>', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan umum saat mengimpor data. Silakan periksa file Anda atau hubungi administrator.');
        }
    }
}