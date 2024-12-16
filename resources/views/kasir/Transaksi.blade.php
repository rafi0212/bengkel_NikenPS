<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 min-h-screen">
    <!-- Header -->
    <div class="bg-indigo-800 text-white flex justify-between items-center p-4">
        <div class="flex items-center space-x-8 ml-[600px]">
            <nav class="flex space-x-9">
                <a href="#" class="text-white hover:text-gray-200">Transaksi</a>
                <a href="#" class="text-white hover:text-gray-200">POS</a>
            </nav>
        </div>
        
        <div class="relative group">
            <!-- Profile Section -->
            <div class="flex items-center space-x-4 cursor-pointer">
                <!-- Profile Picture -->
                <div class="w-10 h-10 bg-red-500 rounded-full"></div>
                
                <!-- Dynamic Username -->
                <span class="text-lg font-medium">
                    {{ auth()->user()->username ?? 'Guest' }}
                </span>
            </div>
        
            <!-- Dropdown Menu -->
            <div 
                class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg 
                       shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                       transition-all duration-300 ease-in-out"
            >
                <form action="{{ route('logout') }}" method="POST" class="p-2">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full text-left px-4 py-2 text-red-500 
                               hover:bg-gray-100 rounded-md"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
    </div>

    <!-- Content -->
    <div class="p-8">
        <!-- Page Title and Button -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manage Transaksi</h2>
            <button 
                onclick="location.href='/Kasir/transaksi/create'" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Transaksi
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Transaksi ID</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Nama Pelanggan</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">tanggal transaksi</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Total harga</th>
                        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                        <tr>
                            <td class="py-3 px-4 border-b">{{ $item->id_transaksi }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->nama_pelanggan }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->tanggal_transaksi }}</td>
                            <td class="py-3 px-4 border-b">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b text-center space-x-2">
                            <a 
                                href="/Kasir/transaksi/edit/{{ $item->id_transaksi }}" 
                                class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </a>
                               
                            <form 
                                action="{{ route('kasir.transaksi.destroy', $item->id_transaksi) }}" 
                                method="POST" 
                                class="inline-block"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                            </form>

                                                            <!-- Ikon 📄 untuk akses detail transaksi -->
                            <a href="{{ route('kasir.detail.show', $item->id_transaksi) }}" class="text-2xl">
                                📄
                            </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            <div class="text-sm text-gray-600">Showing 1 to 5 of 10 entries</div>
            <div class="flex items-center space-x-1">
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-l hover:bg-gray-400">
                    Previous
                </button>
                <button class="px-3 py-1 border bg-blue-500 text-white">1</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">2</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 hover:bg-gray-400">3</button>
                <button class="px-3 py-1 border bg-gray-300 text-gray-700 rounded-r hover:bg-gray-400">
                    Next
                </button>
            </div>
        </div>
    </div>
</body>

</html>
