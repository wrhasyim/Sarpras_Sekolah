@extends('layouts.app')
@section('content')
<h1>Edit Lokasi: {{ $kelas->nama_kelas }}</h1>
<hr>
<form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_kelas" class="form-label">Nama Lokasi</label>
        <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
        @error('nama_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection