<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-800 text-white flex flex-col">
        <div class="py-8 px-6 text-center">
            <h2 class="text-2xl font-bold tracking-wide">NIKEN POWER STEERING</h2>
        </div>
        <nav class="mt-10 flex-grow">
            <a href="/superadmin/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
            <a href="/superadmin/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
            <a href="#" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="#" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="#" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="flex-1">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
            <div class="relative group mr-4">
                <div class="flex items-center space-x-4 cursor-pointer">
                    <div class="w-10 h-10 bg-red-500 rounded-full" style="margin-left: 1060px;"></div> 
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
        
        <!-- Main Content -->
        <div class="p-6">
            <div class="flex justify-between items-center mb-6 mt-8">
                <h2 class="text-2xl font-bold text-gray-700">Manage Product</h2>
                <a href="{{ route('product.create') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg shadow-md">
                    Add Product +
                </a>
            </div>
        
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Table -->
                <table class="table-auto w-full border-collapse">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">No Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Stok</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Harga</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($produk as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $item->no_produk }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $item->nama_produk }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $item->stok }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <!-- Edit Icon -->
                                <a href="{{ route('product.edit', $item->no_produk) }}" 
                                   class="text-blue-500 hover:text-blue-700 mx-2">
                                   ✎
                                </a>
                                <!-- Delete Icon -->
                                <form action="{{ route('product.delete', $item->no_produk) }}" 
                                      method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <!-- Pagination -->
                <div class="flex justify-between items-center p-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        Showing {{ $produk->firstItem() }} to {{ $produk->lastItem() }} of {{ $produk->total() }} entries
                    </div>
                    <div>
                        {{ $produk->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>