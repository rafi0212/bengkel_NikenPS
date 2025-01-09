<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Styling for the header */
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 600px;  /* Set the width in px */
            height: 100px; /* Set the height in px */
            margin-bottom: 10px;
        }

        .kop-surat h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .kop-surat p {
            margin: 5px 0;
            font-size: 14px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling for total row */
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <!-- Kop Surat with Logo -->
    <div class="kop-surat">
        <img src="{{ asset('kop_surat.png') }}" alt="Logo">
        
    </div>

    <!-- Title for the Report -->
    <h2>Laporan Transaksi</h2>

    <!-- Transaction Table -->
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Servis</th>
                <th>Total Product</th>
                <th>Total Keseluruhan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->id_transaksi }}</td>
                    <td>{{ $item->tanggal_transaksi }}</td>
                    <td>{{ $item->nama_pelanggan ?? 'Nama Tidak Tersedia' }}</td>
                    <td>Rp {{ number_format($item->servis ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format(($item->servis ?? 0) + ($item->total_harga ?? 0), 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" style="text-align: right;">Total Keseluruhan:</td>
                <td>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    

    <!-- JavaScript to trigger the print dialog automatically on page load -->
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
