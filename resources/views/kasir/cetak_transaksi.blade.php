<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Bengkel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                height: 100%;
            }

            .bg-white {
                box-shadow: none;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Kop Surat -->
    <div class="w-full text-center mb-6">
        <!-- Menggunakan asset() untuk mengakses gambar dari public/images -->
        <img src="{{ asset('kop_surat.png') }}" alt="Kop Surat" class="w-full max-h-40 object-contain mx-auto">
    </div>

    <div class="bg-white p-6 mx-auto rounded-lg shadow-lg max-w-4xl">
        <!-- Header Nota -->
        <div class="flex justify-between items-start mb-4">
            <!-- Informasi Bengkel -->
            <div class="w-2/3">
                <div class="flex items-center mb-2">
                    <div>
                        <h1 class="text-xl font-bold">NIKEN POWER STREENG</h1>
                        <p class="text-sm">Menerima Servis Motor, Sparepart, Tune Up, Bore Up, Overhaul</p>
                        <p class="text-sm">Servis Injeksi / Reset Injeksi DLL</p>
                        <p class="text-sm mt-2">ID TRANSAKSI: <span class="font-semibold">{{ $transaksi->id_transaksi }}</span></p>
                        <p class="text-sm mt-2">Keterangan Service : <span class="font-semibold">{{ $transaksi->Keterangan_Service }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Detail Pelanggan -->
            <div class="w-1/3 text-sm">
                <p>Kepada Yth,</p>
                <p class="text-sm">Nama Customer  : {{ $transaksi->nama_pelanggan }}</p>
                <p class="text-sm">Tanggal  : {{ $transaksi->tanggal_transaksi ?? 'Alamat tidak tersedia' }}</p>
                <p class="text-sm">Wa: ____________</p>
                <p class="text-sm">NO POL: ____________</p>
            </div>
        </div>

        <!-- Tabel Nota -->
        <div class="mb-4">
            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama Produk</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Qty</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Harga</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detailTransaksi as $detail)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->nama_produk }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $detail->qty }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Harga -->
        <div class="text-right text-sm mb-4">
            <p><strong>service:</strong> Rp {{ number_format($service_fee, 0, ',', '.') }}</p>
            <p><strong>Total Barang:</strong> Rp {{ number_format($total_harga, 0, ',', '.') }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($total_to_be_paid, 0, ',', '.') }}</p>
        </div>

        <!-- Bagian Paling Bawah -->
        <div class="border-t border-gray-300 pt-4">
            <div class="flex justify-between items-center">
                <!-- Tanda Terima -->
                <div class="text-sm">
                    <p>Tanda Terima,</p>
                    <p class="mt-8">______________________</p>
                </div>
                <!-- Hormat Kami -->
                <div class="text-sm text-right">
                    <p>Hormat Kami,</p>
                    <p class="mt-8">______________________</p>
                </div>
            </div>

            <!-- Peringatan -->
            <div class="text-center text-sm font-bold mt-4">
                <p>PERHATIAN !!</p>
                <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
            </div>
        </div>
    </div>

    <script>
        window.onload = () => window.print();
    </script>
</body>

</html>
