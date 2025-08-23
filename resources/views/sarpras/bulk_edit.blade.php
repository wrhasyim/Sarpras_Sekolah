@extends('layouts.app')
@section('content')
<h1>Edit Inventaris Kelas: {{ Auth::user()->kelas->nama_kelas }}</h1>
<p>Di halaman ini, Anda hanya dapat mengubah **Jumlah** dan **Kondisi** barang.</p>
<hr>

<form action="{{ route('sarpras.bulk.update') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 20%;">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sarpras as $item)
            <tr>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>
                    <input type="number" name="items[{{ $item->id }}][jumlah]" class="form-control" value="{{ old('items.'.$item->id.'.jumlah', $item->jumlah) }}" min="0">
                </td>
                <td>
                    <select name="items[{{ $item->id }}][kondisi]" class="form-select">
                        <option value="baik" {{ old('items.'.$item->id.'.kondisi', $item->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak_ringan" {{ old('items.'.$item->id.'.kondisi', $item->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak_berat" {{ old('items.'.$item->id.'.kondisi', $item->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data inventaris di kelas Anda.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($sarpras->isNotEmpty())
    <div class="mt-3">
        <a href="{{ route('sarpras.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Semua Perubahan</button>
    </div>
    @endif
</form>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection