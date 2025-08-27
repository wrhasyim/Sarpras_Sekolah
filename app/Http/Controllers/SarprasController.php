<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Impor Validator

class SarprasController extends Controller
{
    /**
     * Menampilkan daftar sarpras.
     */
    public function index()
    {
        $sarpras = Sarpras::with('kelas')->latest()->paginate(10);
        return view('sarpras.index', compact('sarpras'));
    }

    /**
     * Menampilkan form untuk membuat sarpras baru.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('sarpras.create', compact('kelas'));
    }

    /**
     * Menyimpan data sarpras baru beserta validasi jumlah.
     */
    public function store(Request $request)
    {
        // Validasi input dasar
        $validator = Validator::make($request->all(), [
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

        // Validasi kustom untuk memastikan jumlah total sesuai
        $jumlah_total = (int) $request->input('jumlah');
        $jumlah_kondisi = (int) $request->input('kondisi_baik') + (int) $request->input('kondisi_rusak_ringan') + (int) $request->input('kondisi_rusak_berat');

        if ($jumlah_kondisi !== $jumlah_total) {
            $selisih = $jumlah_kondisi - $jumlah_total;
            $pesan = '';
            if ($selisih > 0) {
                $pesan = "Jumlah total dari semua kondisi (baik, rusak ringan, rusak berat) adalah {$jumlah_kondisi}, yaitu kelebihan {$selisih} dari jumlah total barang ({$jumlah_total}).";
            } else {
                $selisih_abs = abs($selisih);
                $pesan = "Jumlah total dari semua kondisi (baik, rusak ringan, rusak berat) adalah {$jumlah_kondisi}, yaitu kekurangan {$selisih_abs} dari jumlah total barang ({$jumlah_total}).";
            }
            // Kirim error kembali ke form
            return redirect()->back()->withInput()->withErrors(['jumlah_total' => $pesan]);
        }

        Sarpras::create($request->all());

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail sarpras.
     */
    public function show(Sarpras $sarpras)
    {
        return view('sarpras.show', compact('sarpras'));
    }

    /**
     * Menampilkan form untuk mengedit sarpras.
     */
    public function edit(Sarpras $sarpras)
    {
        $kelas = Kelas::all();
        return view('sarpras.edit', compact('sarpras', 'kelas'));
    }

    /**
     * Memperbarui data sarpras beserta validasi jumlah.
     */
    public function update(Request $request, Sarpras $sarpras)
    {
        // Validasi input dasar
        $validator = Validator::make($request->all(), [
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

        // Validasi kustom untuk memastikan jumlah total sesuai
        $jumlah_total = (int) $request->input('jumlah');
        $jumlah_kondisi = (int) $request->input('kondisi_baik') + (int) $request->input('kondisi_rusak_ringan') + (int) $request->input('kondisi_rusak_berat');

        if ($jumlah_kondisi !== $jumlah_total) {
            $selisih = $jumlah_kondisi - $jumlah_total;
            $pesan = '';
            if ($selisih > 0) {
                $pesan = "Jumlah total dari semua kondisi (baik, rusak ringan, rusak berat) adalah {$jumlah_kondisi}, yaitu kelebihan {$selisih} dari jumlah total barang ({$jumlah_total}).";
            } else {
                $selisih_abs = abs($selisih);
                $pesan = "Jumlah total dari semua kondisi (baik, rusak ringan, rusak berat) adalah {$jumlah_kondisi}, yaitu kekurangan {$selisih_abs} dari jumlah total barang ({$jumlah_total}).";
            }
            // Kirim error kembali ke form
            return redirect()->back()->withInput()->withErrors(['jumlah_total' => $pesan]);
        }
        
        $sarpras->update($request->all());

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diperbarui.');
    }


    /**
     * Menghapus data sarpras.
     */
    public function destroy(Sarpras $sarpras)
    {
        $sarpras->delete();
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil dihapus.');
    }
}