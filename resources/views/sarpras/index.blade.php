@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Sarana Prasarana</h1>
        @can('is_admin_or_tu')
        <a href="{{ route('sarpras.create') }}" class="btn btn-primary">Tambah Sarpras</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th> {{-- <-- KOLOM BARU --}}
                            <th>Nama Barang</th>
                            <th>Lokasi</th>
                            <th>Jumlah</th>
                            <th>Kondisi Baik</th>
                            <th>Rusak Ringan</th>
                            <th>Rusak Berat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sarpras as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_barang }}</td> {{-- <-- DATA BARU --}}
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kelas->nama_kelas ?? 'Belum dialokasikan' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->kondisi_baik }}</td>
                            <td>{{ $item->kondisi_rusak_ringan }}</td>
                            <td>{{ $item->kondisi_rusak_berat }}</td>
                            <td>
                                @can('is_admin_or_tu')
                                    <a href="{{ route('sarpras.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('sarpras.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                @else
                                    -
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data sarpras.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $sarpras->links() }}
            </div>
        </div>
    </div>
</div>
@endsection