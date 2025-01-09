<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
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

    <!-- Form Container -->
    <div class="max-w-md mx-auto bg-white mt-10 p-6 rounded-lg shadow-lg">
        <h1 class="text-xl font-bold text-center mb-6">Edit Transaksi</h1>
        <form action="{{ route('kasir.transaksi.update', $transaksi->id_transaksi) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <!-- Metode PUT untuk update -->
        
            <!-- Transaksi ID -->
            <div>
                <label for="id_transaksi" class="block text-sm font-medium">Transaksi ID</label>
                <input type="number" id="id_transaksi" name="id_transaksi" value="{{ $transaksi->id_transaksi }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>
        
            <!-- Nama Pelanggan -->
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Tanggal Transaksi -->
            <div>
                <label for="tanggal_transaksi" class="block text-sm font-medium">Tanggal Transaksi</label>
                <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Keterangan Service (Dropdown) -->
            <div>
                <label for="Keterangan_Service" class="block text-sm font-medium">Keterangan Service</label>
                <select id="Keterangan_Service" name="Keterangan_Service" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Keterangan Service</option>
                    <option value="Power Steering Pump" {{ $transaksi->Keterangan_Service == 'Power Steering Pump' ? 'selected' : '' }}>Power Steering Pump</option>
                    <option value="Seal Kit" {{ $transaksi->Keterangan_Service == 'Seal Kit' ? 'selected' : '' }}>Seal Kit</option>
                    <option value="Rotary Kit" {{ $transaksi->Keterangan_Service == 'Rotary Kit' ? 'selected' : '' }}>Rotary Kit</option>
                    <option value="Housing Pump" {{ $transaksi->Keterangan_Service == 'Housing Pump' ? 'selected' : '' }}>Housing Pump</option>
                    <option value="Pressure Hose" {{ $transaksi->Keterangan_Service == 'Pressure Hose' ? 'selected' : '' }}>Pressure Hose</option>
                    <option value="Back Hose" {{ $transaksi->Keterangan_Service == 'Back Hose' ? 'selected' : '' }}>Back Hose</option>
                    <option value="Supply Hose" {{ $transaksi->Keterangan_Service == 'Supply Hose' ? 'selected' : '' }}>Supply Hose</option>
                    <option value="Boot Steer" {{ $transaksi->Keterangan_Service == 'Boot Steer' ? 'selected' : '' }}>Boot Steer</option>
                    <option value="Insulock Ties L/R" {{ $transaksi->Keterangan_Service == 'Insulock Ties L/R' ? 'selected' : '' }}>Insulock Ties L/R</option>
                    <option value="Rack Steer" {{ $transaksi->Keterangan_Service == 'Rack Steer' ? 'selected' : '' }}>Rack Steer</option>
                    <option value="Control Valve" {{ $transaksi->Keterangan_Service == 'Control Valve' ? 'selected' : '' }}>Control Valve</option>
                    <option value="Tie Rod / Long Tie Rod L/R" {{ $transaksi->Keterangan_Service == 'Tie Rod / Long Tie Rod L/R' ? 'selected' : '' }}>Tie Rod / Long Tie Rod L/R</option>
                    <option value="ATF Oil" {{ $transaksi->Keterangan_Service == 'ATF Oil' ? 'selected' : '' }}>ATF Oil</option>
                    <option value="Grease" {{ $transaksi->Keterangan_Service == 'Grease' ? 'selected' : '' }}>Grease</option>
                    <option value="Service Charge/Setting" {{ $transaksi->Keterangan_Service == 'Service Charge/Setting' ? 'selected' : '' }}>Service Charge/Setting</option>
                    <option value="." {{ $transaksi->Keterangan_Service == '.' ? 'selected' : '' }}>.</option>
                </select>
            </div>
        
            <!-- Servis -->
            <div>
                <label for="servis" class="block text-sm font-medium">Service</label>
                <input type="number" id="servis" name="servis" value="{{ $transaksi->servis }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Total Harga -->
            <div>
                <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
                <input type="number" id="total_harga" name="total_harga" value="{{ $transaksi->total_harga }}" 
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <!-- Buttons -->
            <div class="flex justify-between gap-4">
                <button type="button" onclick="window.history.back()" 
                        class="w-full py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Batal</button>
                <button type="submit" 
                        class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Update</button>
            </div>
        </form>
        
    </div>
</body>

</html>
