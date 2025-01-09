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
            <a href="/dashboard" class="block py-2.5 px-6 hover:bg-indigo-700">Dashboard</a>
            <a href="/Owner/userread" class="block py-2.5 px-6 hover:bg-indigo-700">User</a>
            <a href="/Owner/productread" class="block py-2.5 px-6 hover:bg-indigo-700">Product</a>
            <a href="/Owner/kategoriread" class="block py-2.5 px-6 hover:bg-indigo-700">Kategori</a>
            <a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Transaksi</a>
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
                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM12 16c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                
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

        <!-- Card Section for Total Values -->
        <div class="grid grid-cols-3 gap-6 mt-8">
            <!-- Total Penjualan Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold">Total Penjualan</h3>
                <p class="text-4xl font-bold mt-2">{{ $salesData->sum() }}</p>  <!-- Total Penjualan -->
            </div>

            <!-- Total Produk Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold">Total Produk</h3>
                <p class="text-4xl font-bold mt-2">{{ $products->total() }}</p>  <!-- Total Produk -->
            </div>

            <!-- Total Cash Flow Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold"><a href="/Owner/transaksiread" class="block py-2.5 px-6 hover:bg-indigo-700">Arus Kas</a></h3>
                <p class="text-4xl font-bold mt-2">Rp {{ number_format($cashFlowData->sum(), 0, ',', '.') }}</p>  <!-- Total Arus Kas -->
                
            </div>
        </div>

        <!-- Chart Section - Below the cards -->
        <div class="mt-8">
            <div class="grid grid-cols-2 gap-6">
                <!-- Penjualan & Produk Combined Chart (Stacked Bar Chart) -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Penjualan & Produk (Grafik Batang Bertumpuk)</h3>
                    <canvas id="salesProductChart" class="w-full h-[200px] mt-4"></canvas> <!-- Grafik Batang Bertumpuk untuk Penjualan dan Produk -->
                </div>

                <!-- Cash Flow Chart (Line Chart) -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Arus Kas (Grafik Garis)</h3>
                    <canvas id="cashFlowChart" class="w-full h-[200px] mt-4"></canvas> <!-- Grafik Garis Arus Kas -->
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesProductChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(range(1, 12)),  // Mengelompokkan berdasarkan bulan (1-12)
                datasets: [
                    {
                        label: 'Penjualan',
                        data: @json($salesData->values()), // Mengirim data penjualan dinamis
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    },
                    {
                        label: 'Produk',
                        data: @json($productsData->values()), // Mengirim data produk dinamis
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
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

        // Data Arus Kas - Grafik Garis
        const cashFlowCtx = document.getElementById('cashFlowChart').getContext('2d');
        const cashFlowChart = new Chart(cashFlowCtx, {
            type: 'line',
            data: {
                labels: @json(range(1, 12)),  // Label untuk bulan 1-12
                datasets: [{
                    label: 'Arus Kas',
                    data: @json($cashFlowData->values()),  // Data Arus Kas
                    borderColor: 'rgba(255, 99, 132, 1)',  // Warna untuk Garis Arus Kas
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',  // Warna untuk Garis Arus Kas
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true  // Set Y-axis untuk mulai dari 0
                    }
                }
            }
        });
    </script>
</body>
</html>
