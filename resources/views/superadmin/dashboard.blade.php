<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

    <!-- Main Content -->
    <div class="flex-grow p-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Dashboard</h1>

            <!-- Admin Profile & Dropdown -->
            <div class="relative group">
                
                <div class="flex items-center space-x-4 cursor-pointer">
                    <!-- Avatar di kiri -->
                    <div class="w-10 h-10 bg-red-500 rounded-full"></div>
                
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

        <!-- Card Section -->
        <div class="grid grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold">Total Penjualan</h3>
                <p class="text-4xl font-bold mt-2">10</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold">Total Product</h3>
                <p class="text-4xl font-bold mt-2">18</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold">Jumlah Customer</h3>
                <p class="text-4xl font-bold mt-2">15</p>
            </div>
        </div>

         <!-- Chart Section -->
        <div class="mt-8 bg-white p-3 rounded-lg shadow-lg">
            <canvas id="myChart" class="w-full h-[900px] max-h-[425px]"></canvas> <!-- Mengatur tinggi dan tinggi maksimum -->
        </div>

        
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                datasets: [
                    {
                        label: 'Penjualan',
                        data: [12, 19, 3, 5, 2, 3, 10, 20, 15, 8],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    },
                    {
                        label: 'Produk',
                        data: [10, 15, 7, 10, 5, 12, 8, 15, 10, 7],
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    },
                    {
                        label: 'Customer',
                        data: [8, 12, 15, 5, 7, 10, 13, 9, 5, 12],
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>