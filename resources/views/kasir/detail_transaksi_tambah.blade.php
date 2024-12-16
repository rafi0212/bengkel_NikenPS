<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body>
<header class="flex items-center justify-between p-4 bg-indigo-500 shadow-md">
    <div class="flex items-center">
        <img src="https://via.placeholder.com/50" alt="Logo Shell" class="h-10 w-10" />
        <nav class="ml-4">
            <a href="#" class="text-lg font-semibold text-white mx-2">Point Of Sales</a>
            <a href="{{ route('kasir.detail.show', $transaksi->id_transaksi) }}" class="text-lg font-semibold text-white mx-2">Riwayat Pesanan</a>
        </nav>
    </div>
    <div class="relative group">
        <div class="flex items-center space-x-4 cursor-pointer">
            <div class="w-10 h-10 bg-red-500 rounded-full"></div>
            <span class="text-white text-lg font-medium">Guest</span>
        </div>
        <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
            <form action="#" method="POST" class="p-2">
                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 rounded-md">Logout</button>
            </form>
        </div>
    </div>
</header>

<main class="p-4">
    <div class="flex justify-between gap-4">
        <!-- Kategori dan Produk -->
        <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg w-2/3">
            <h1 class="text-2xl font-bold mb-4">Produk bengkel</h1>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <!-- Loop Produk -->    
                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-lg p-3">
                        @if ($product->gambar_produk)
                            <img src="{{ asset('storage/' . $product->gambar_produk) }}" alt="Gambar Produk" class="w-24 h-24 object-cover mx-auto mb-2">
                        @else
                            <span class="text-muted block text-center mb-4">Tidak ada gambar</span>
                        @endif
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->nama_produk }}</h2>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                        <!-- Tombol Add -->
                        <button class="mt-1 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 add-to-order" data-id="{{ $product->no_produk }}" data-name="{{ $product->nama_produk }}" data-price="{{ $product->harga }}">Add</button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Form Pesanan -->
        <div class="w-1/3 pl-1 pr-3">
            <form action="{{ route('kasir.detail.tambahDetailProduk', $transaksi->id_transaksi) }}" method="POST" class="bg-white p-4 rounded-lg shadow-md w-full">
                @csrf
                <div class="mb-4 flex items-center justify-between">
                    <label for="id_transaksi" class="text-lg font-semibold w-1/3">ID Transaksi</label>
                    <div class="w-2/3">
                        <span class="text-lg font-semibold">{{ $transaksi->id_transaksi }}</span>
                    </div>
                </div>
                
                <div class="mb-4 flex items-center justify-between">
                    <label for="nama_pelanggan" class="text-lg font-semibold w-1/3">Nama Pelanggan</label>
                    <div class="w-2/3">
                        <span class="text-lg font-semibold">{{ $transaksi->nama_pelanggan }}</span>
                    </div>
                </div>
                
                <div id="product-list" class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Produk yang Dipilih:</h3>
                    <ul id="selected-products">
                        <!-- List produk yang dipilih akan ditambahkan di sini -->
                    </ul>
                </div>
                
                <input type="hidden" id="selected-products-data" name="selected_products">
                
                <div class="mb-4">
                    <label class="block text-lg font-semibold">Service</label>
                    <input type="text" class="border-2 border-indigo-500 rounded-lg p-2 w-full" name="service" />
                </div>
                
                <div class="mb-4">
                    <label for="total_harga" class="block text-lg font-semibold">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" value="Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}" class="border-2 border-indigo-500 rounded-lg p-2 w-full" readonly />
                </div>
                
                <div class="flex justify-between">
                    <button type="reset" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg">Bersihkan</button>
                    <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg">tambah detail transaksi</button>
                </div>
            </form>            
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order');
    const productListContainer = document.getElementById('selected-products');
    const totalHargaInput = document.getElementById('total_harga');
    let selectedProducts = {};  // This will hold products and quantities

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = parseFloat(this.dataset.price);

            if (selectedProducts[productId]) {
                selectedProducts[productId].quantity++;
            } else {
                selectedProducts[productId] = { id: productId, name: productName, price: productPrice, quantity: 1 };
            }

            renderSelectedProducts();
        });
    });

    function renderSelectedProducts() {
        productListContainer.innerHTML = '';
        for (let productId in selectedProducts) {
            const product = selectedProducts[productId];
            const productElement = document.createElement('li');
            productElement.classList.add('flex', 'justify-between', 'items-center', 'border-b', 'pb-2');
            productElement.innerHTML = `
                <span>${product.name}</span>
                <div class="flex items-center space-x-2">
                    <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 decrease" data-id="${productId}">-</button>
                    <span class="px-3 py-1 bg-gray-100 rounded">${product.quantity}</span>
                    <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 increase" data-id="${productId}">+</button>
                </div>
            `;
            productListContainer.appendChild(productElement);
        }
        updateTotal();
    }

    function updateTotal() {
        const total = Object.values(selectedProducts).reduce((sum, product) => sum + (product.price * product.quantity), 0);
        totalHargaInput.value = `Rp ${total.toLocaleString()}`;
    }

    productListContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('increase')) {
            const productId = e.target.dataset.id;
            selectedProducts[productId].quantity++;
            renderSelectedProducts();
        } else if (e.target.classList.contains('decrease')) {
            const productId = e.target.dataset.id;
            if (selectedProducts[productId].quantity > 1) {
                selectedProducts[productId].quantity--;
                renderSelectedProducts();
            }
        }
    });

    document.querySelector('form').addEventListener('submit', function (e) {
    // Ensure data is being passed as an array of objects
    const productsArray = Object.values(selectedProducts).map(product => ({
        id: product.id,
        quantity: product.quantity
    }));

    // Convert to JSON string before submitting
    document.getElementById('selected-products-data').value = JSON.stringify(productsArray);
});

});
</script>
</body>
</html>
