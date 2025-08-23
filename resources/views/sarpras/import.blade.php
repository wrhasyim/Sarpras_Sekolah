@extends('layouts.app')
@section('content')
<h1>Impor Data Sarpras dari Excel</h1>
<hr>

@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Petunjuk Impor Data</h5>
        <ol>
            <li>Unduh template file excel yang sudah disediakan.</li>
            <li>Isi data sesuai dengan kolom yang ada. **Pastikan `kode_barang` unik** untuk setiap item.</li>
            <li>Kolom `lokasi_kelas` harus diisi dengan nama lokasi yang **sudah ada** di sistem.</li>
            <li>Kolom `kondisi` harus diisi dengan salah satu dari: `Baik`, `Rusak Ringan`, atau `Rusak Berat`.</li>
            <li>Jika `kode_barang` sudah ada di sistem, data akan di-update. Jika belum ada, data baru akan dibuat.</li>
            <li>Upload file yang sudah diisi pada form di bawah ini.</li>
        </ol>
        <a href="{{ route('sarpras.export') }}" class="btn btn-success mb-3">
            <i class="bi bi-download"></i> Unduh Template / Ekspor Data
        </a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Upload File Excel</h5>
        <form action="{{ route('sarpras.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Pilih file (.xlsx, .xls)</label>
                <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" required>
                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <a href="{{ route('sarpras.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Impor Data</button>
        </form>
    </div>
</div>
@endsection