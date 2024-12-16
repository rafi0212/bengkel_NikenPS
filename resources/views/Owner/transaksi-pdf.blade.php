<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .kop-surat { text-align: center; margin-bottom: 20px; }
        .kop-surat h1 { margin: 0; font-size: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h1>NIKEN POWER STEERING</h1>
        <p>Alamat: Jl. Contoh, Kota, Provinsi</p>
        <p>No. Telp: (021) 123456789</p>
    </div>

    <h2>Laporan Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->id_transaksi }}</td>
                    <td>{{ $item->tanggal_transaksi }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
