@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Data Sarana Prasarana
        @if(Auth::user()->role == 'wali_kelas')
            <small class="text-muted fs-5">- Kelas {{ Auth::user()->kelas->nama_kelas }}</small>
        @endif
    </h1>
    <div>
        @if(in_array(Auth::user()->role, ['admin', 'tu']))
            <a href="{{ route('sarpras.import.form') }}" class="btn btn-info">Impor Data</a>
            <a href="{{ route('sarpras.create') }}" class="btn btn-primary">Tambah Data</a>
        @elseif(Auth::user()->role == 'wali_kelas')
            <a href="{{ route('sarpras.bulk.edit') }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Edit Inventaris Kelas
            </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Lokasi (Kelas)</th>
            <th>Aksi</th> {{-- <-- BAGIAN YANG DITAMBAHKAN --}}
        </tr>
    </thead>
    <tbody>
        @forelse($sarpras as $item)
        <tr>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>
                <span class="badge 
                    @if($item->kondisi == 'baik') bg-success 
                    @elseif($item->kondisi == 'rusak_ringan') bg-warning 
                    @else bg-danger @endif">
                    {{ str_replace('_', ' ', $item->kondisi) }}
                </span>
            </td>
            <td>{{ $item->kelas->nama_kelas }}</td>
            
            {{-- BAGIAN YANG DIPERBAIKI --}}
            <td>
                @if(in_array(Auth::user()->role, ['admin', 'tu']))
                    <a href="{{ route('sarpras.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endif

                @if(Auth::user()->role == 'admin')
                    <form action="{{ route('sarpras.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                @endif
                
                @if(Auth::user()->role == 'wali_kelas')
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $sarpras->links() }}

@endsection