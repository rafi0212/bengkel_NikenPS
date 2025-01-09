<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaksi</title>
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
        <!-- Header -->
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
            <div class="relative group mr-4">
                <div class="flex items-center space-x-4 cursor-pointer" style="margin-left: 1060px;">
                    <!-- User Icon (Heroicons) -->
                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM12 16c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <span class="text-lg font-medium">
                        {{ auth()->user()->username ?? 'Guest' }}
                    </span>
                </div>
                
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
        
        <!--  -->
        <div class="p-6">
            <div class="flex justify-between items-center mb-6 mt-8">
                <h2 class="text-2xl font-bold text-gray-700">Menu Transaksi</h2>
                <div>
                    <a href="{{ route('transaksi.print') }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600  mr-2">
                        Cetak Transaksi PDF
                    </a>                    
                    <a href="{{ route('transaksi.export.excel') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">
                        Cetak Excel
                    </a>
                </div>
            </div>
            
        
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Table -->
                <table class="table-auto w-full border-collapse">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">ID Transaksi</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal Transaksi</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Pelanggan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Service</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Total Product</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Total Harga</th>
                           
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transaksi as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $item->id_transaksi }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">
                                {{ $item->tanggal_transaksi }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">
                                {{ $item->nama_pelanggan ?? 'Nama Tidak Tersedia' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">
                                Rp {{ number_format($item->servis ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">
                                Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">
                                Rp {{ number_format(($item->servis ?? 0) + ($item->total_harga ?? 0), 0, ',', '.') }}
                            </td>
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="flex justify-between items-center p-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        Showing {{ $transaksi->firstItem() }} to {{ $transaksi->lastItem() }} of {{ $transaksi->total() }} entries
                    </div>
                    <div>
                        {{ $transaksi->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
