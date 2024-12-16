<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <div class="bg-blue-700 text-white px-6 py-3 flex justify-between items-center">
        <div class="flex gap-6">
            <a href="#" class="font-bold hover:underline">Transaksi</a>
            <a href="#" class="font-bold hover:underline">POS</a>
        </div>
        <div class="bg-red-500 w-8 h-8 rounded-full"></div>
    </div>

    <!-- Form Container -->
    <div class="max-w-md mx-auto bg-white mt-10 p-6 rounded-lg shadow-lg">
        <h1 class="text-xl font-bold text-center mb-6">Edit Transaksi</h1>
        <form action="{{ route('kasir.transaksi.update', $transaksi->id_transaksi) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <!-- Metode PUT untuk update -->
        
            <!-- Transaksi ID -->
            <div>
                <label for="id_transaksi" class="block text-sm font-medium">Transaksi ID</label>
                <input type="number" id="id_transaksi" name="id_transaksi" value="{{ $transaksi->id_transaksi }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>
        
            <!-- Nama Pelanggan -->
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Tanggal Transaksi -->
            <div>
                <label for="tanggal_transaksi" class="block text-sm font-medium">Tanggal Transaksi</label>
                <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Total Harga -->
            <div>
                <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
                <input type="number" id="total_harga" name="total_harga" value="{{ $transaksi->total_harga }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Buttons -->
            <div class="flex justify-between gap-4">
                <button type="button" onclick="window.history.back()" 
                        class="w-full py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Batal</button>
                <button type="submit" 
                        class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
        
    </div>
</body>
</html>
