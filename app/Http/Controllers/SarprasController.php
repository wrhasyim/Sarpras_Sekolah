<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\Kelas;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\SarprasImport;
use App\Exports\SarprasExport;
use Maatwebsite\Excel\Facades\Excel;

class SarprasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Sarpras::with('kelas');

        if ($user->role == 'wali_kelas') {
            $query->where('kelas_id', $user->kelas_id);
        }

        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        $sarpras = $query->paginate(10);
        return view('sarpras.index', compact('sarpras'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('sarpras.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:sarpras',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'kelas_id' => 'required',
        ]);

        Sarpras::create($request->all());
        Log::create(['user_id' => Auth::id(), 'aktivitas' => 'Menambahkan barang baru: ' . $request->nama_barang]);

        return redirect()->route('sarpras.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Sarpras $sarpras)
    {
        $user = Auth::user();
        // Blokir Wali Kelas dari halaman edit individual
        if ($user->role == 'wali_kelas') {
            abort(403, 'AKSES DITOLAK. Gunakan halaman Edit Inventaris Kelas.');
        }

        $kelas = Kelas::all();
        return view('sarpras.edit', compact('sarpras', 'kelas'));
    }

    public function update(Request $request, Sarpras $sarpras)
    {
        $user = Auth::user();
        // Blokir Wali Kelas dari proses update individual
        if ($user->role == 'wali_kelas') {
            abort(403, 'AKSES DITOLAK.');
        }

        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'kelas_id' => 'required',
        ]);

        $sarpras->update($request->all());
        Log::create(['user_id' => Auth::id(), 'aktivitas' => 'Mengubah data barang: ' . $sarpras->nama_barang]);

        return redirect()->route('sarpras.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Sarpras $sarpras)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        Log::create(['user_id' => Auth::id(), 'aktivitas' => 'Menghapus barang: ' . $sarpras->nama_barang]);
        $sarpras->delete();

        return redirect()->route('sarpras.index')->with('success', 'Data berhasil dihapus.');
    }

    public function showImportForm()
    {
        return view('sarpras.import');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new SarprasImport, $request->file('file'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diimpor.');
    }

    public function export()
    {
        return Excel::download(new SarprasExport, 'data-sarpras.xlsx');
    }

    /**
     * Menampilkan form edit massal untuk Wali Kelas.
     */
    public function showBulkEditForm()
    {
        $user = Auth::user();
        $sarpras = Sarpras::where('kelas_id', $user->kelas_id)->get();
        return view('sarpras.bulk_edit', compact('sarpras'));
    }

  }