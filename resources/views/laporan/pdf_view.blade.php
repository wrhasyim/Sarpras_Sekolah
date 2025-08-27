<!DOCTYPE html>
<html>
<head>
    <title>Laporan Perbandingan Sarana Prasarana</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 6px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h1 { text-align: center; margin-bottom: 5px; font-size: 16pt; }
        h3 { margin-top: 25px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; font-size: 12pt;}
        .page-break { page-break-after: always; }
        .header-info { text-align: center; margin-bottom: 25px; }
        .text-success { color: #28a745; }
        .text-danger { color: #dc3545; }
        .text-warning { color: #ffc107; }
        .font-weight-bold { font-weight: bold; }
        .badge { display: inline-block; padding: .25em .4em; font-size: 75%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25rem; }
        .badge-light { color: #212529; background-color: #f8f9fa; }
        .badge-info { color: #fff; background-color: #17a2b8; }
    </style>
</head>
<body>
    <div class="header-info">
        <h1>Laporan Perbandingan Inventaris Sarana Prasarana</h1>
        <p>
            Laporan Bulan: <strong>{{ \Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}</strong>
            <br>
            (Dibandingkan dengan {{ $prevBulan->format('F Y') }})
        </p>
    </div>

    @forelse($rekaps as $namaKelas => $rekapPerKelas)
        <h3>Lokasi: {{ $namaKelas }}</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 25%;">Barang</th>
                    <th style="width: 8%;">Baik</th>
                    <th style="width: 10%;">R. Ringan</th>
                    <th style="width: 10%;">R. Berat</th>
                    <th style="width: 10%;">Jumlah</th>
                    <th>Keterangan Perubahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapPerKelas as $rekap)
                    @php
                        $key = $rekap->sarpras_id . '-' . $rekap->kelas_id;
                        $rekapLalu = $rekapsSebelumnya->get($key);
                        $isNew = !$rekapLalu;
                        $perubahan = [];
                        if (!$isNew) {
                            $diffBaik = $rekap->kondisi_baik - $rekapLalu->kondisi_baik;
                            $diffRingan = $rekap->kondisi_rusak_ringan - $rekapLalu->kondisi_rusak_ringan;
                            $diffBerat = $rekap->kondisi_rusak_berat - $rekapLalu->kondisi_rusak_berat;

                            if ($diffBaik != 0) $perubahan[] = "Baik: " . ($diffBaik > 0 ? '+' : '') . $diffBaik;
                            if ($diffRingan != 0) $perubahan[] = "R. Ringan: " . ($diffRingan > 0 ? '+' : '') . $diffRingan;
                            if ($diffBerat != 0) $perubahan[] = "R. Berat: " . ($diffBerat > 0 ? '+' : '') . $diffBerat;
                        }
                    @endphp
                    <tr>
                        <td>
                            {{ $rekap->sarpras->nama_barang }}
                            @if($isNew)
                                <span class="badge badge-info">Baru</span>
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $rekap->kondisi_baik }}</td>
                        <td style="text-align: center;">{{ $rekap->kondisi_rusak_ringan }}</td>
                        <td style="text-align: center;">{{ $rekap->kondisi_rusak_berat }}</td>
                        <td style="text-align: center;" class="font-weight-bold">{{ $rekap->jumlah }}</td>
                        <td>
                            @if($isNew)
                                Barang baru ditambahkan bulan ini.
                            @elseif(empty($perubahan))
                                Tidak ada perubahan kondisi.
                            @else
                                {{ implode(', ', $perubahan) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @empty
        <p style="text-align: center;">Tidak ada data rekapitulasi untuk periode yang dipilih.</p>
    @endforelse
</body>
</html>