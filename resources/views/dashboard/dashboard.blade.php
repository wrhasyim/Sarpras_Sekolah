@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Sarpras</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSarpras }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Lokasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLokasi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengguna
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Kondisi Sarpras</h6>
                </div>
                <div class="card-body">
                    {{-- PERBAIKAN: Menampilkan data dari $kondisiCounts --}}
                    @foreach($kondisiCounts as $kondisi => $total)
                        <h4 class="small font-weight-bold">{{ $kondisi }} <span class="float-right">{{ $total }}</span></h4>
                        <div class="progress mb-4">
                            @php
                                $persentase = $totalSarpras > 0 ? ($total / $totalSarpras) * 100 : 0;
                                $warna = 'bg-success';
                                if($kondisi == 'Rusak Ringan') $warna = 'bg-warning';
                                if($kondisi == 'Rusak Berat') $warna = 'bg-danger';
                            @endphp
                            <div class="progress-bar {{ $warna }}" role="progressbar" style="width: {{ $persentase }}%"
                                aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sarpras Terbaru</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($sarprasTerbaru as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $item->nama_barang }}</h6>
                                    <small class="text-muted">{{ $item->kelas->nama_kelas ?? 'N/A' }}</small>
                                </div>
                                <span class="badge badge-primary badge-pill">{{ $item->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="list-group-item">Tidak ada data sarpras.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection