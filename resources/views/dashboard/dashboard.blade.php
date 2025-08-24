@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    {{-- KARTU STATISTIK --}}
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-box-seam"></i> Total Jenis Barang</h5>
                    <p class="card-text fs-4">{{ $totalSarpras }} Jenis</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-geo-alt"></i> Total Lokasi</h5>
                    <p class="card-text fs-4">{{ $totalLokasi }} Lokasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Total Pengguna</h5>
                    <p class="card-text fs-4">{{ $totalUser }} Pengguna</p>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Proporsi Kondisi Barang</h5>
                    <canvas id="kondisiChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Top 5 Lokasi Inventaris</h5>
                    <canvas id="lokasiChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL INFORMASI CEPAT --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Barang Baru Ditambahkan
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            @forelse ($sarprasTerbaru as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->nama_barang }}</strong><br>
                                        <small class="text-muted">{{ $item->kode_barang }} - di {{ $item->kelas->nama_kelas }}</small>
                                    </td>
                                    {{-- PERUBAHAN DI SINI --}}
                                    <td class="text-end">{{ optional($item->created_at)->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td>Tidak ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Aktivitas Terbaru
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                             @forelse ($logTerbaru as $log)
                                <tr>
                                    <td>
                                        <strong>{{ $log->user->name ?? 'User Dihapus' }}</strong><br>
                                        <small class="text-muted">{{ $log->aktivitas }}</small>
                                    </td>
                                     {{-- PERUBAHAN DI SINI --}}
                                    <td class="text-end">{{ optional($log->created_at)->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td>Tidak ada aktivitas.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- Library Chart.js dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data untuk Pie Chart Kondisi
    const kondisiLabels = {!! json_encode($kondisiLabels) !!};
    const kondisiData = {!! json_encode($kondisiData) !!};
    const kondisiCtx = document.getElementById('kondisiChart').getContext('2d');
    const kondisiChart = new Chart(kondisiCtx, {
        type: 'pie',
        data: {
            labels: kondisiLabels.map(label => label.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())),
            datasets: [{
                label: 'Jumlah Barang',
                data: kondisiData,
                backgroundColor: [
                    'rgba(25, 135, 84, 0.7)',  // Success
                    'rgba(255, 193, 7, 0.7)',   // Warning
                    'rgba(220, 53, 69, 0.7)'    // Danger
                ],
                borderColor: [
                    'rgba(25, 135, 84, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    });

    // Data untuk Bar Chart Lokasi
    const lokasiLabels = {!! json_encode($lokasiLabels) !!};
    const lokasiData = {!! json_encode($lokasiData) !!};
    const lokasiCtx = document.getElementById('lokasiChart').getContext('2d');
    const lokasiChart = new Chart(lokasiCtx, {
        type: 'bar',
        data: {
            labels: lokasiLabels,
            datasets: [{
                label: 'Total Jumlah Barang',
                data: lokasiData,
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush