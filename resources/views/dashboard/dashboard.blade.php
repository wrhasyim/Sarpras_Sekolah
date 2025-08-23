@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Barang</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalBarang }} Unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Kondisi Baik</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $barangBaik }} Unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Rusak Ringan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $barangRusakRingan }} Unit</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Rusak Berat</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $barangRusakBerat }} Unit</h5>
                </div>
            </div>
        </div>
    </div>

    @endsection