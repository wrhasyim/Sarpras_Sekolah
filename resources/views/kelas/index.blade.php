@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manajemen Lokasi (Kelas)</h1>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Lokasi</a>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kelas as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nama_kelas }}</td>
            <td>
                <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus lokasi ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $kelas->links() }}
@endsection