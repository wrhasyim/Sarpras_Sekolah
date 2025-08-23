<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\Kelas;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SarprasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Sarpras::with('kelas');

        // Filter untuk Wali Kelas
        if ($user->role == 'wali_kelas') {
            $query->where('kelas_id', $user->kelas_id);
        }

        // Filter berdasarkan pencarian
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
        // Otorisasi: Wali kelas hanya bisa edit data kelasnya
        if ($user->role == 'wali_kelas' && $sarpras->kelas_id != $user->kelas_id) {
            abort(403, 'AKSES DITOLAK');
        }
        
        $kelas = Kelas::all();
        return view('sarpras.edit', compact('sarpras', 'kelas'));
    }

    public function update(Request $request, Sarpras $sarpras)
    {
        $user = Auth::user();
        if ($user->role == 'wali_kelas' && $sarpras->kelas_id != $user->kelas_id) {
            abort(403);
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
        // Hanya Admin yang bisa hapus
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        
        Log::create(['user_id' => Auth::id(), 'aktivitas' => 'Menghapus barang: ' . $sarpras->nama_barang]);
        $sarpras->delete();

        return redirect()->route('sarpras.index')->with('success', 'Data berhasil dihapus.');
    }
}