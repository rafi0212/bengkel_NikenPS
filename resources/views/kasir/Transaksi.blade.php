<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<header class="flex items-center justify-between p-4 bg-indigo-600 shadow-md rounded-b-lg">
    <div class="flex items-center">
        <img src="{{ asset('logo.jpg') }}" alt="Logo Shell" class="h-10 w-10 rounded-full border-2 border-white" />
        <nav class="ml-4">
            <a href="{{ route('kasir.transaksi.index') }}" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Point Of Sales</a>
            <a href="/Kasir/transaksishow" class="text-lg font-semibold text-white mx-2 hover:underline transition duration-300">Riwayat Pesanan</a>
        </nav>
    </div>
    <div class="relative group">
        <div class="flex items-center space-x-4 cursor-pointer">
            <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM12 16c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <span class="text-white text-lg font-medium">{{ auth()->user()->username ?? 'Guest' }}</span>
        </div>
        <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
            <form action="{{ route('logout') }}" method="POST" class="p-2">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 rounded-md">Logout</button>
            </form>
        </div>
    </div>
</header>

<!-- Content -->
<div class="p-8">
    <!-- Page Title and Button -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manage Transaksi</h2>
        <button 
            onclick="location.href='{{ route('kasir.transaksi.create') }}'" 
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
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Tanggal Transaksi</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Service</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Keterangan Service</th> <!-- Keterangan Servis -->
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Total Barang</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-600 border-r">Total Harga</th>
                    <th class="py-3 px-4 text-center text-sm font-medium text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                    <tr>
                        <td class="py-3 px-4 border-b">{{ $item->id_transaksi }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->nama_pelanggan }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->tanggal_transaksi }}</td>
                        <td class="py-3 px-4 border-b">Rp {{ number_format($item->servis, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">{{ $item->Keterangan_Service }}</td> 
                        <td class="py-3 px-4 border-b">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border-b">
                            Rp {{ number_format(($item->servis ?? 0) + ($item->total_harga ?? 0), 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 border-b text-center space-x-2">
                            <!-- Edit Transaction -->
                            <a href="/Kasir/transaksi/edit/{{ $item->id_transaksi }}" class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </a>
                            
                            <!-- Delete Transaction -->
                            <form action="{{ route('kasir.transaksi.destroy', $item->id_transaksi) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                            </form>

                            <!-- Detail Transaction -->
                            <a href="{{ route('kasir.detail.show', $item->id_transaksi) }}" class="text-2xl">
                                📄
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data transaksi.</td>
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
