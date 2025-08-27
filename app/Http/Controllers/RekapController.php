<?php

namespace App\Http\Controllers;

use App\Models\RekapSarpras;
use App\Models\Sarpras;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        $rekaps = RekapSarpras::with('sarpras')->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->paginate(10);
        return view('rekap.index', compact('rekaps'));
    }

    public function create()
    {
        $sarpras = Sarpras::all();
        return view('rekap.create', compact('sarpras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sarpras_id' => 'required|exists:sarpras,id',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2000',
            'jumlah' => 'required|integer|min:0',
            'kondisi_baik' => 'required|integer|min:0',
            'kondisi_rusak_ringan' => 'required|integer|min:0',
            'kondisi_rusak_berat' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        RekapSarpras::create($request->all());

        return redirect()->route('rekap.index')->with('success', 'Rekap berhasil ditambahkan.');
    }
}