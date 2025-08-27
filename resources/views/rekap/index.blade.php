@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekap Sarana Prasarana Bulanan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form Generate Rekap --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat atau Perbarui Rekap Otomatis</h6>
        </div>
        <div class="card-body">
            <p>Pilih bulan dan tahun untuk mengambil "snapshot" dari data sarpras saat ini dan menyimpannya sebagai rekap.</p>
            <form action="{{ route('rekap.generate') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mr-2 mb-2">
                    <label for="bulan_generate" class="sr-only">Bulan</label>
                    <select name="bulan" id="bulan_generate" class="form-control" required>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mr-2 mb-2">
                    <label for="tahun_generate" class="sr-only">Tahun</label>
                    <input type="number" name="tahun" id="tahun_generate" class="form-control" value="{{ date('Y') }}" min="2020" max="{{ date('Y') + 5 }}" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="bi bi-camera-fill"></i> Buat Rekap Bulan Ini
                </button>
            </form>
        </div>
    </div>


    {{-- Form Filter Tampilan --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tampilkan Rekap</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekap.index') }}" method="GET" class="form-row align-items-end">
                <div class="form-group col-md-4">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $filterBulan == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $filterTahun }}" min="2020">
                </div>
                <div class="form-group col-md-3">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">Semua Kelas</option>
                        @foreach ($daftarKelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ $filterKelas == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-info w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Tabel Hasil Rekap --}}
    @forelse($rekaps as $namaKelas => $rekapPerKelas)
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold">{{ $namaKelas }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>Barang</th>
                                <th>Kondisi Baik</th>
                                <th>Rusak Ringan</th>
                                <th>Rusak Berat</th>
                                <th>Jumlah Total</th>
                                <th>Perbandingan (vs {{ $prevBulan->format('F Y') }})</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekapPerKelas as $rekap)
                                @php
                                    $key = $rekap->sarpras_id . '-' . $rekap->kelas_id;
                                    $rekapLalu = $rekapsSebelumnya[$key] ?? null;

                                    $diffBaik = $rekapLalu ? $rekap->kondisi_baik - $rekapLalu->kondisi_baik : 0;
                                    $diffRingan = $rekapLalu ? $rekap->kondisi_rusak_ringan - $rekapLalu->kondisi_rusak_ringan : 0;
                                    $diffBerat = $rekapLalu ? $rekap->kondisi_rusak_berat - $rekapLalu->kondisi_rusak_berat : 0;
                                @endphp
                                <tr>
                                    <td>{{ $rekap->sarpras->nama_barang }}</td>
                                    <td>{{ $rekap->kondisi_baik }}</td>
                                    <td>{{ $rekap->kondisi_rusak_ringan }}</td>
                                    <td>{{ $rekap->kondisi_rusak_berat }}</td>
                                    <td><strong>{{ $rekap->jumlah }}</strong></td>
                                    <td>
                                        @if($rekapLalu)
                                            <span class="badge badge-{{ $diffBaik > 0 ? 'success' : ($diffBaik < 0 ? 'danger' : 'secondary') }}">
                                                Baik: {{ $diffBaik > 0 ? '+' : '' }}{{ $diffBaik }}
                                            </span>
                                            <span class="badge badge-{{ $diffRingan > 0 ? 'warning' : ($diffRingan < 0 ? 'success' : 'secondary') }}">
                                                R. Ringan: {{ $diffRingan > 0 ? '+' : '' }}{{ $diffRingan }}
                                            </span>
                                            <span class="badge badge-{{ $diffBerat > 0 ? 'danger' : ($diffBerat < 0 ? 'success' : 'secondary') }}">
                                                R. Berat: {{ $diffBerat > 0 ? '+' : '' }}{{ $diffBerat }}
                                            </span>
                                        @else
                                            <span class="badge badge-dark">Data bulan lalu tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">
            Tidak ada data rekap untuk periode yang dipilih. Silakan coba buat rekap terlebih dahulu.
        </div>
    @endforelse
</div>
@endsection