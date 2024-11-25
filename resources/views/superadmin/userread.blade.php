<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    
        <aside class="w-64 bg-indigo-800 text-white flex flex-col">
            <div class="py-8 px-6 text-center">
                <h2 class="text-2xl font-bold tracking-wide">NIKEN POWER STEERING</h2>
            </div>
            <nav class="mt-10 flex-grow">
                <a href="/superadmin/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
                <a href="/superadmin/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
                <a href="/superadmin/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
            </nav>
        </aside>
    

        <!-- Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
                
                <!-- Admin Profile & Dropdown -->
                <div class="relative group mr-4">
                    <div class="flex items-center space-x-4 cursor-pointer">
                        <!-- Avatar di kiri -->
                        <div class="w-10 h-10 bg-red-500 rounded-full" style="margin-left: 1060px;"></div> 
                    
                        <!-- Nama pengguna tampil dinamis -->
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
            
            <!-- Header tabel -->
            <div class="p-6">
                <div class="flex justify-between items-center mb-6 mt-8">
                    <h2 class="text-2xl font-bold text-gray-700">Manage User</h2>
                    <a href="" 
                       class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg shadow-md">
                        User +
                    </a>
                </div>
            
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Table -->
                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $user->username }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300">{{ $user->status_pekerjaan }}</td>
                                <td class="px-6 py-4 text-center">
                                    <!-- Edit Icon -->
                                    <a href="{{ route('usermenu.edit', $user->email) }}" 
                                       class="text-blue-500 hover:text-blue-700 mx-2">
                                       ✎
                                    </a>
                                    <!-- Delete Icon -->
                                    <form action="{{ route('usermenu.delete', $user->email) }}" 
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
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                        </div>
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
                        <div>
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</body>
</html>
