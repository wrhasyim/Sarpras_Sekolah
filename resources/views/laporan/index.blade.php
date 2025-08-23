@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Sarana Prasarana</h1>
    <hr>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Unduh Laporan Inventaris</h5>
            <p class="card-text">Pilih format laporan yang ingin Anda unduh. Laporan akan berisi semua data inventaris sarana prasarana yang ada di sistem.</p>
            <a href="{{ route('laporan.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Unduh Laporan Excel
            </a>
            <a href="{{ route('laporan.pdf') }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Unduh Laporan PDF
            </a>
        </div>
    </div>
</div>
@endsection