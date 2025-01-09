<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
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
    <div class="flex-1">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
            <h1 class="text-xl font-semibold">Edit Kategori</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('kategori.update', $category->kode_kategori) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kode_kategori" class="block text-gray-700 font-bold mb-2">Kode Kategori</label>
                    <input 
                        type="text" 
                        name="kode_kategori" 
                        id="kode_kategori" 
                        value="{{ $category->kode_kategori }}" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        readonly>
                </div>

                <div class="mb-4">
                    <label for="nama_kategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        value="{{ $category->nama_kategori }}" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Update 
                </button>
                <a href="{{ url()->previous() }}" 
                    class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
                    Batal
                </a>
            </form>
        </div>
    </div>

</body>
</html>
