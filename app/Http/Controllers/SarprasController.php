<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\Kelas;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SarprasController extends Controller
{
    use AuthorizesRequests;

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

        // PERBAIKAN: Menambahkan field 'activity' saat membuat log
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
        $this->authorize('is_admin_or_tu');
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

        // PERBAIKAN: Menambahkan field 'activity' saat membuat log
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Memperbarui data sarpras: ' . $sarpras->nama_barang,
        ]);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diperbarui.');
    }

    public function destroy(Sarpras $sarpras)
    {
        $this->authorize('is_admin_or_tu');
        $nama_barang = $sarpras->nama_barang;
        $sarpras->delete();

        // PERBAIKAN: Menambahkan field 'activity' saat membuat log
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Menghapus data sarpras: ' . $nama_barang,
        ]);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil dihapus.');
    }

    public function showBulkEditForm()
    {
        $user = Auth::user();
        if ($user->role !== 'wali_kelas' || !$user->kelas_id) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses atau belum ditugaskan ke kelas.');
        }
        $sarprasItems = Sarpras::where('kelas_id', $user->kelas_id)->get();
        return view('sarpras.bulk_edit', compact('sarprasItems'));
    }

    public function bulkUpdate(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'wali_kelas') {
            abort(403);
        }
        $validatedData = $request->validate([
            'sarpras' => 'required|array',
            'sarpras.*.kondisi_baik' => 'required|integer|min:0',
            'sarpras.*.kondisi_rusak_ringan' => 'required|integer|min:0',
            'sarpras.*.kondisi_rusak_berat' => 'required|integer|min:0',
            'sarpras.*.keterangan' => 'nullable|string',
        ]);

        foreach ($validatedData['sarpras'] as $id => $data) {
            $item = Sarpras::where('id', $id)->where('kelas_id', $user->kelas_id)->first();
            if ($item) {
                $data['jumlah'] = $data['kondisi_baik'] + $data['kondisi_rusak_ringan'] + $data['kondisi_rusak_berat'];
                $item->update($data);
            }
        }

        // PERBAIKAN: Menambahkan field 'activity' saat membuat log
        Log::create([
            'user_id' => $user->id,
            'activity' => 'Wali Kelas memperbarui data sarpras di kelasnya.',
        ]);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras kelas berhasil diperbarui.');
    }
}