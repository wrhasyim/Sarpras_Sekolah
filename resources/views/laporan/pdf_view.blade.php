<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sarana Prasarana</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; margin-bottom: 5px; }
        h3 { margin-top: 25px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .page-break { page-break-after: always; }
        .header-info { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header-info">
        <h1>Laporan Inventaris Sarana Prasarana</h1>
        <p>Tanggal Laporan: {{ date('d F Y') }}</p>
    </div>

    {{-- Lakukan looping untuk setiap kelas --}}
    @foreach($semua_kelas as $kelas)
        <h3>Lokasi: {{ $kelas->nama_kelas }}</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="width: 10%;">Jumlah</th>
                    <th style="width: 15%;">Kondisi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Lakukan looping untuk setiap barang di dalam kelas ini --}}
                @foreach($kelas->sarpras as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->kondisi)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Memberi jeda halaman agar tidak terpotong (opsional) --}}
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>