<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Links -->
            <div class="flex gap-8">
                <a href="#" class="font-bold hover:underline">Transaksi</a>
                <a href="#" class="font-bold hover:underline">POS</a>
            </div>
            <!-- Profile Icon -->
            <div class="bg-red-500 w-10 h-10 rounded-full flex items-center justify-center">
                <span class="text-lg font-bold">A</span>
            </div>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="max-w-3xl mx-auto bg-white mt-12 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-8">Tambah Transaksi</h1>

        <form action="/Kasir/transaksi" method="POST" class="space-y-6">
            @csrf

            <!-- Transaksi ID -->
            <div>
                <label for="id_transaksi" class="block text-sm font-medium text-gray-700">Transaksi ID</label>
                <input type="number" id="id_transaksi" name="id_transaksi" 
                       class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Nama Pelanggan -->
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" 
                       class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Tanggal Transaksi -->
            <div>
                <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" 
                       class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Total Harga -->
            <div>
                <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                <input type="text" id="total_harga" name="total_harga" 
                       class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify gap-4">
                <button type="button" onclick="window.history.back()" 
                        class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
