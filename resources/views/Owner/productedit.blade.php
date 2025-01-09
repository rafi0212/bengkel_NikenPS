<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-800 text-white flex flex-col">
        <div class="py-8 px-6 text-center">
            <h2 class="text-2xl font-bold tracking-wide">NIKEN POWER STEERING</h2>
        </div>
        <nav class="mt-10 flex-grow">
            <a href="/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
            <a href="/Owner/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

        <form 
            action="{{ route('productmenu.update', $product->no_produk) }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="bg-white p-6 rounded-lg shadow-md space-y-6"
        >
            @csrf
            @method('PUT')

            <!-- No Produk (Read-only) -->
            <div class="mb-4">
                <label for="no_produk" class="block text-sm font-medium text-gray-700">No Produk</label>
                <input 
                    type="text" 
                    name="no_produk" 
                    id="no_produk" 
                    value="{{ $product->no_produk }}" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500" 
                    readonly
                >
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label for="kode_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select 
                    name="kode_kategori" 
                    id="kode_kategori" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
                    @foreach ($categories as $category)
                        <option 
                            value="{{ $category->kode_kategori }}" 
                            {{ $product->kode_kategori == $category->kode_kategori ? 'selected' : '' }}
                        >
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input 
                    type="text" 
                    name="nama_produk" 
                    id="nama_produk" 
                    value="{{ $product->nama_produk }}" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Gambar Produk -->
            <div class="mb-4">
                <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input 
                    type="file" 
                    name="gambar_produk" 
                    id="gambar_produk" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    accept="image/*"
                >
                @if ($product->gambar_produk)
                    <img 
                        src="{{ asset('storage/' . $product->gambar_produk) }}" 
                        alt="Gambar Produk" 
                        class="mt-4 w-32 h-32 object-cover rounded-lg shadow-md"
                    >
                @endif
            </div>

            <!-- Stok -->
            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input 
                    type="number" 
                    name="stok" 
                    id="stok" 
                    value="{{ $product->stok }}" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input 
                    type="number" 
                    name="harga" 
                    id="harga" 
                    value="{{ $product->harga }}" 
                    class="mt-1 block w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg ">
                Update
            </button>
            <a href="{{ url()->previous() }}" 
                class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600">
                Batal
            </a>
        </form>
    </div>
</body>
</html>
