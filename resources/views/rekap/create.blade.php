@extends('layouts.app')

@section('content')
<h1>Tambah Rekap Bulanan</h1>
<hr>
<form action="{{ route('rekap.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="sarpras_id" class="form-label">Sarpras</label>
        <select class="form-select" id="sarpras_id" name="sarpras_id" required>
            @foreach($sarpras as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="number" class="form-control" id="bulan" name="bulan" min="1" max="12" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" min="2000" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="kondisi_baik" class="form-label">Kondisi Baik</label>
            <input type="number" class="form-control" id="kondisi_baik" name="kondisi_baik" min="0" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="kondisi_rusak_ringan" class="form-label">Rusak Ringan</label>
            <input type="number" class="form-control" id="kondisi_rusak_ringan" name="kondisi_rusak_ringan" min="0" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="kondisi_rusak_berat" class="form-label">Rusak Berat</label>
            <input type="number" class="form-control" id="kondisi_rusak_berat" name="kondisi_rusak_berat" min="0" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
    </div>
    <a href="{{ route('rekap.index') }}" class="btn btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection