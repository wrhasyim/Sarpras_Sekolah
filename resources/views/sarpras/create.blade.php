@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Sarpras Baru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Sarpras</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('sarpras.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    {{-- INPUT BARU UNTUK KODE BARANG --}}
                    <div class="form-group col-md-6">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
                        @error('kode_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kelas_id">Lokasi (Kelas)</label>
                    <select class="form-control" id="kelas_id" name="kelas_id">
                        <option value="">Pilih Lokasi/Kelas</option>
                        @foreach($kelasList as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="jumlah">Jumlah Total</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', 0) }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kondisi_baik">Kondisi Baik</label>
                        <input type="number" class="form-control" id="kondisi_baik" name="kondisi_baik" value="{{ old('kondisi_baik', 0) }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kondisi_rusak_ringan">Rusak Ringan</label>
                        <input type="number" class="form-control" id="kondisi_rusak_ringan" name="kondisi_rusak_ringan" value="{{ old('kondisi_rusak_ringan', 0) }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kondisi_rusak_berat">Rusak Berat</label>
                        <input type="number" class="form-control" id="kondisi_rusak_berat" name="kondisi_rusak_berat" value="{{ old('kondisi_rusak_berat', 0) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                </div>
                <a href="{{ route('sarpras.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection