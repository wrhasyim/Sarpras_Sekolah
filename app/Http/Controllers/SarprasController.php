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
        $search = $request->input('search');

        $query = Sarpras::with('kelas')
            ->when($search, function ($query, $search) {
                return $query->where('nama_barang', 'like', "%{$search}%")
                             ->orWhere('kode_barang', 'like', "%{$search}%")
                             ->orWhereHas('kelas', function ($q) use ($search) {
                                 $q->where('nama_kelas', 'like', "%{$search}%");
                             });
            });

        if ($user->role == 'wali_kelas') {
            $query->where('kelas_id', $user->kelas_id);
        }

        $sarpras = $query->latest()->paginate(10);

        return view('sarpras.index', compact('sarpras'));
    }

    public function create()
    {
        $this->authorize('is_admin_or_tu');
        $kelasList = Kelas::all();
        return view('sarpras.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $this->authorize('is_admin_or_tu');

        // PERBAIKAN: Tambahkan validasi untuk kode_barang
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:255|unique:sarpras,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jumlah' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak_ringan' => 'required|integer|min:0',
            'kondisi_rusak_berat' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Sarpras::create($validatedData);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Menambahkan data sarpras baru: ' . $validatedData['nama_barang'],
        ]);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil ditambahkan.');
    }

    public function edit(Sarpras $sarpras)
    {
        $this->authorize('is_admin_or_tu');
        $kelasList = Kelas::all();
        return view('sarpras.edit', compact('sarpras', 'kelasList'));
    }

    public function update(Request $request, Sarpras $sarpras)
    {
        $user = Auth::user();

        // PERBAIKAN: Tambahkan validasi untuk kode_barang saat update
        $rules = [
            'kode_barang' => 'required|string|max:255|unique:sarpras,kode_barang,' . $sarpras->id,
            'nama_barang' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jumlah' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak_ringan' => 'required|integer|min:0',
            'kondisi_rusak_berat' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);
        $sarpras->update($validatedData);

        Log::create([
            'user_id' => $user->id,
            'activity' => 'Memperbarui data sarpras: ' . $sarpras->nama_barang,
        ]);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diperbarui.');
    }

    public function destroy(Sarpras $sarpras)
    {
        $this->authorize('is_admin_or_tu');
        $nama_barang = $sarpras->nama_barang;
        $sarpras->delete();

        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Menghapus data sarpras: ' . $nama_barang,
        ]);
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil dihapus.');
    }
}