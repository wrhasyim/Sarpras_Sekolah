<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sarpras</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h3 { text-align: center; }
    </style>
</head>
<body>
    @if($data['latestRekap'])
        @php
            $bulanNama = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            // Mengakses bulan dan tahun dari dalam array $data
            $bulan = $bulanNama[$data['latestRekap']->bulan];
            $tahun = $data['latestRekap']->tahun;
        @endphp
        <h2>Laporan Inventaris Sarana Prasarana</h2>
        <h3>Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
    @else
        <h2>Laporan Inventaris Sarana Prasarana</h2>
        <h3>Data Rekap Belum Tersedia</h3>
    @endif

    @foreach($data['kelasData'] as $kelas)
        <h4>Kelas: {{ $kelas->nama_kelas }}</h4>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Baik</th>
                    <th>Rusak Ringan</th>
                    <th>Rusak Berat</th>
                    <th>Jumlah Bulan Lalu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas->sarpras as $item)
                    <tr>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kondisi_baik }}</td>
                        <td>{{ $item->kondisi_rusak_ringan }}</td>
                        <td>{{ $item->kondisi_rusak_berat }}</td>
                        <td>
                            @if($data['selectedRekap'] && isset($data['selectedRekap'][$item->id]))
                                {{ $data['selectedRekap'][$item->id]->jumlah_bulan_lalu }}
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach
</body>
</html>