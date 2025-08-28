@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Sarpras</h1>

    <form action="{{ route('sarpras.store') }}" method="POST">
        @csrf

        {{-- Pesan error validasi jumlah --}}
        @if ($errors->has('jumlah_total'))
            <div class="alert alert-danger">
                <strong>Error:</strong> {{ $errors->first('jumlah_total') }}
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
            @error('kode_barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
            @error('nama_barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="jumlah">Jumlah Total</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
            @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="kondisi_baik">Kondisi Baik</label>
                    <input type="number" class="form-control @error('kondisi_baik') is-invalid @enderror" id="kondisi_baik" name="kondisi_baik" value="{{ old('kondisi_baik') }}" required>
                    @error('kondisi_baik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="kondisi_rusak_ringan">Kondisi Rusak Ringan</label>
                    <input type="number" class="form-control @error('kondisi_rusak_ringan') is-invalid @enderror" id="kondisi_rusak_ringan" name="kondisi_rusak_ringan" value="{{ old('kondisi_rusak_ringan') }}" required>
                    @error('kondisi_rusak_ringan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="kondisi_rusak_berat">Kondisi Rusak Berat</label>
                    <input type="number" class="form-control @error('kondisi_rusak_berat') is-invalid @enderror" id="kondisi_rusak_berat" name="kondisi_rusak_berat" value="{{ old('kondisi_rusak_berat') }}" required>
                    @error('kondisi_rusak_berat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="kelas_id">Lokasi (Kelas)</label>
            <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sarpras.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection