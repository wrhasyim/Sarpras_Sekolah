<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sarpras</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        h2, h3 { text-align: center; }
        .page-break { page-break-before: always; }
        .text-center { text-align: center; }
        .text-success { color: green; }
        .text-danger { color: red; }
        .keterangan { font-size: 9px; }
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
            $bulan = $bulanNama[$data['latestRekap']->bulan];
            $tahun = $data['latestRekap']->tahun;
        @endphp
        <h2>Laporan Inventaris Sarana Prasarana</h2>
        <h3>Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
    @else
        <h2>Laporan Inventaris Sarana Prasarana</h2>
        <h3>Data Rekap Belum Tersedia</h3>
    @endif

    @foreach($data['kelasData'] as $index => $kelas)
        <div @if($index > 0) class="page-break" @endif>
            <h4>Kelas: {{ $kelas->nama_kelas }}</h4>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Kode</th>
                        <th rowspan="2">Nama Barang</th>
                        <th colspan="3">Kondisi Saat Ini</th>
                        <th rowspan="2">Total Saat Ini</th>
                        <th rowspan="2">Total Bulan Lalu</th>
                        <th rowspan="2">Selisih</th>
                        <th rowspan="2">Keterangan Perubahan</th>
                    </tr>
                    <tr>
                        <th>Baik</th>
                        <th>RR</th>
                        <th>RB</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas->sarpras as $item)
                        @php
                            $rekapLalu = $data['rekapBulanLalu']->get($item->id);
                            $jumlahLalu = $rekapLalu->jumlah_bulan_lalu ?? 0;
                            $selisihJumlah = $item->jumlah - $jumlahLalu;

                            $keterangan = [];
                            if ($rekapLalu) {
                                // Bandingkan kondisi
                                $selisihBaik = $item->kondisi_baik - $rekapLalu->kondisi_baik;
                                $selisihRR = $item->kondisi_rusak_ringan - $rekapLalu->kondisi_rusak_ringan;
                                $selisihRB = $item->kondisi_rusak_berat - $rekapLalu->kondisi_rusak_berat;

                                if ($selisihBaik > 0) $keterangan[] = "Baik <span class='text-success'>(+{$selisihBaik}})</span>";
                                if ($selisihBaik < 0) $keterangan[] = "Baik <span class='text-danger'>({$selisihBaik}})</span>";

                                if ($selisihRR > 0) $keterangan[] = "RR <span class='text-success'>(+{$selisihRR}})</span>";
                                if ($selisihRR < 0) $keterangan[] = "RR <span class='text-danger'>({$selisihRR}})</span>";

                                if ($selisihRB > 0) $keterangan[] = "RB <span class='text-success'>(+{$selisihRB}})</span>";
                                if ($selisihRB < 0) $keterangan[] = "RB <span class='text-danger'>({$selisihRB}})</span>";
                            } else {
                                $keterangan[] = "Barang baru";
                            }

                            if (empty($keterangan) && $selisihJumlah != 0) {
                                $keterangan[] = "Perpindahan/Stok Opname";
                            } elseif (empty($keterangan) && $selisihJumlah == 0) {
                                $keterangan[] = "Tidak ada perubahan";
                            }
                        @endphp
                        <tr>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td class="text-center">{{ $item->kondisi_baik }}</td>
                            <td class="text-center">{{ $item->kondisi_rusak_ringan }}</td>
                            <td class="text-center">{{ $item->kondisi_rusak_berat }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-center">{{ $jumlahLalu }}</td>
                            <td class="text-center">
                                @if($selisihJumlah > 0)
                                    <span class="text-success">+{{ $selisihJumlah }}</span>
                                @elseif($selisihJumlah < 0)
                                    <span class="text-danger">{{ $selisihJumlah }}</span>
                                @else
                                    {{ $selisihJumlah }}
                                @endif
                            </td>
                            <td class="keterangan">{!! implode(', ', $keterangan) !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
    @endforeach
</body>
</html>