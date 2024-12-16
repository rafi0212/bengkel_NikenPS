<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEWAKODING-KASIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-6">DEWAKODING-KASIR</h1>

        <!-- Navigation -->
        <div class="flex justify-center space-x-4 mb-6">
            <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Tampilan POS</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Produk</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Daftar Order</button>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-12 gap-4">
            <!-- Products -->
            <div class="col-span-8">
                <div class="mb-4">
                    <input type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Search">
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-lg">
                            @if ($product->gambar_produk)
                            <img src="{{ $product->gambar_produk }}" alt="Gambar Produk"style="width: 100px; height: 100px; display: block; margin: 0 auto;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $product->nama_produk }}</h2>
                                <p class="text-gray-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <button class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Invoice -->
            <div class="col-span-4">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-lg font-semibold">Invoice ID: 382324</h2>
                    <ul class="mt-4 space-y-2">
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>Kuah Soto</span>
                            <div class="flex items-center space-x-2">
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">-</button>
                                <span class="px-3 py-1 bg-gray-100 rounded"></span>
                                <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">+</button>
                            </div>
                        </li>
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>Kentang Goreng</span>
                            <div class="flex items-center space-x-2">
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">-</button>
                                <span class="px-3 py-1 bg-gray-100 rounded">3</span>
                                <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">+</button>
                            </div>
                        </li>
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>Kopi Pandan</span>
                            <div class="flex items-center space-x-2">
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">-</button>
                                <span class="px-3 py-1 bg-gray-100 rounded">8</span>
                                <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">+</button>
                            </div>
                        </li>
                        <!-- Tambahkan item lainnya -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
