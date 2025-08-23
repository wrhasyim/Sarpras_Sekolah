@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Sarpras: {{ $sarpras->nama_barang }}</h1>
    <hr>
    
    <form action="{{ route('sarpras.update', $sarpras->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $sarpras->kode_barang }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $sarpras->nama_barang }}" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $sarpras->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label for="kondisi" class="form-label">Kondisi</label>
            <select class="form-select" id="kondisi" name="kondisi">
                <option value="baik" {{ $sarpras->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak_ringan" {{ $sarpras->kondisi == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak_berat" {{ $sarpras->kondisi == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Lokasi (Kelas)</label>
            <select class="form-select" id="kelas_id" name="kelas_id">
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $sarpras->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $sarpras->keterangan }}</textarea>
        </div>

        <a href="{{ route('sarpras.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection