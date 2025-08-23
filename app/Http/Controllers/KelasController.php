<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kelas' => 'required|string|max:255|unique:kelas']);
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(Kelas $kela) // Laravel < 11 might use $kela
    {
        return view('kelas.edit', ['kelas' => $kela]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate(['nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $kela->id]);
        $kela->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        // Cek apakah ada sarpras yang terkait dengan kelas ini
        if ($kela->sarpras()->count() > 0) {
            return redirect()->route('kelas.index')->with('error', 'Lokasi tidak dapat dihapus karena masih memiliki data sarpras terkait.');
        }
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}