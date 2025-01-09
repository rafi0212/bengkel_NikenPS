<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Transaksi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <header class="bg-indigo-600 shadow-md rounded-b-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <img src="https://via.placeholder.com/50" alt="Logo" class="h-10 w-10 rounded-full border-2 border-white" />
                <nav class="ml-4">
                    <a href="{{ route('kasir.transaksi.index') }}" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Point Of Sales</a>
                    <a href="/Kasir/transaksishow" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Riwayat Pesanan</a>
                </nav>
            </div>
            <div class="relative group">
                <div class="flex items-center space-x-4 cursor-pointer">
                    <div class="w-10 h-10 bg-red-500 rounded-full"></div>
                    <span class="text-white text-lg font-medium">{{ auth()->user()->username ?? 'Guest' }}</span>
                </div>
                <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                    <form action="{{ route('logout') }}" method="POST" class="p-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 rounded-md">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-md mt-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Detail Transaksi</h2>

        <!-- Form for editing product details -->
        <form action="{{ route('kasir.detail.update', [$transaksi->id_transaksi, $detail_transaksi->no_produk]) }}" method="POST">
            @csrf
        @method('PUT')

            <div class="space-y-6">

                <!-- Nama Produk -->
                <div class="flex items-center space-x-4">
                    <label for="produk" class="w-1/3 text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" id="produk" value="{{ $detail_transaksi->nama_produk }}" readonly
                        class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Quantity -->
                <div class="flex items-center space-x-4">
                    <label for="qty" class="w-1/3 text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="qty" value="{{ old('qty', $detail_transaksi->qty) }}" required
                        class="w-2/3 p-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500" oninput="updateSubTotal()">
                </div>

                <!-- Harga (read-only) -->
                <div class="flex items-center space-x-4">
                    <label for="harga" class="w-1/3 text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" readonly
                        class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Sub Total (calculated) -->
                <div class="flex items-center space-x-4">
                    <label for="sub_total" class="w-1/3 text-sm font-medium text-gray-700">Sub Total</label>
                    <input type="text" id="sub_total" value="Rp {{ number_format($detail_transaksi->sub_total, 0, ',', '.') }}" readonly
                        class="w-2/3 p-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('kasir.detail.show', $transaksi->id_transaksi) }}" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                       Kembali
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateSubTotal() {
            var qty = document.querySelector('input[name="qty"]').value;
            var harga = document.querySelector('input[name="harga"]').value;
            var subTotal = qty * harga;  // Perhitungan subtotal tanpa service
            document.getElementById('sub_total').value = "Rp " + subTotal.toLocaleString();
        }
    </script>

</body>
</html>
