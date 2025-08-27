@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Rekap Sarana Prasarana Bulanan</h1>
    <a href="{{ route('rekap.create') }}" class="btn btn-primary">Tambah Rekap</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Barang</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>Kondisi Baik</th>
            <th>Rusak Ringan</th>
            <th>Rusak Berat</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($rekaps as $rekap)
        <tr>
            <td>{{ $rekap->sarpras->nama_barang }}</td>
            <td>{{ $rekap->bulan }}</td>
            <td>{{ $rekap->tahun }}</td>
            <td>{{ $rekap->jumlah }}</td>
            <td>{{ $rekap->kondisi_baik }}</td>
            <td>{{ $rekap->kondisi_rusak_ringan }}</td>
            <td>{{ $rekap->kondisi_rusak_berat }}</td>
            <td>{{ $rekap->keterangan }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data rekap.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $rekaps->links() }}
@endsection