<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-800 text-white flex flex-col">
        <div class="py-8 px-6 text-center">
            <h2 class="text-2xl font-bold tracking-wide">NIKEN POWER STEERING</h2>
        </div>
        <nav class="mt-10 flex-grow">
            <a href="/Owner/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
            <a href="/Owner/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="flex-1">
        <div class="flex justify-between items-center bg-white shadow-md px-6 py-4">
            <h1 class="text-xl font-semibold">Create User</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('usermenu.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="status_pekerjaan" class="block text-gray-700 font-bold mb-2">Role</label>
                    <select 
                        name="status_pekerjaan" 
                        id="status_pekerjaan" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-indigo-200">
                        <option value="Superadmin">Superadmin</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>

                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Create User
                </button>
            </form>
        </div>
    </div>
</body>
</html>
