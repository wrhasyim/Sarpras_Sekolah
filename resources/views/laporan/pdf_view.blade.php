<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sarana Prasarana</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Inventaris Sarana Prasarana</h1>
    <p>Tanggal Laporan: {{ date('d-m-Y') }}</p>
    <hr>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sarpras as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $item->kondisi)) }}</td>
                <td>{{ $item->kelas->nama_kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>