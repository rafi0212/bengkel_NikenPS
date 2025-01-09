<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body>
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

<main class="p-4">
    <div class="flex justify-between gap-4">
        <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg w-2/3">
            <h1 class="text-2xl font-bold mb-4">Produk Bengkel Niken Power Streeng</h1>
            <div class="mb-6 flex items-center justify-between">
                <input type="text" id="search" class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Produk..." aria-label="Search products">
                <button class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none" onclick="searchProducts()">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                @foreach ($products as $product)
                    <div class="product-item bg-white rounded-lg shadow-lg p-3 transition-transform transform hover:scale-105">
                        @if ($product->gambar_produk)
                            <img src="{{ asset('storage/' . $product->gambar_produk) }}" alt="Gambar Produk" class="w-24 h-24 object-cover mx-auto mb-2">
                        @else
                            <span class="text-muted block text-center mb-4">Tidak ada gambar</span>
                        @endif
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->nama_produk }}</h2>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <button class="mt-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 add-to-order" 
                                data-id="{{ $product->no_produk }}" 
                                data-name="{{ $product->nama_produk }}" 
                                data-price="{{ $product->harga }}"
                                data-stock="{{ $product->stok }}">
                            Add
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="max-w-3xl mx-auto bg-white mt-12 p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-gray-700 mb-8">Tambah Transaksi</h1>
            <form method="POST" action="{{ route('kasir.detail.tambahDetailProduk') }}" id="transaksi-form">
                @csrf
                <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">

                <div id="selected-products-container" class="mb-4">
                    <!-- Produk yang dipilih akan ditambahkan di sini -->
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <div class="text-lg font-semibold mr-5">
                        Total: Rp <span id="total-harga">0</span>
                    </div>
                    <button type="submit" class="mt-1 px-6 py-2 bg-green-600 text-white  rounded-md hover:bg-green-700 transition">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addToOrderButtons = document.querySelectorAll('.add-to-order');
    const selectedProductsContainer = document.getElementById('selected-products-container');
    const totalHargaSpan = document.getElementById('total-harga');
    const transaksiForm = document.getElementById('transaksi-form');
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup', searchProducts);

    let selectedProducts = {};
    let totalHarga = 0;

    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = parseFloat(this.dataset.price);
            const productStock = parseInt(this.dataset.stock);

            if (selectedProducts[productId]) {
                // Cek apakah stok mencukupi
                if (selectedProducts[productId].quantity >= productStock) {
                    alert('Stok produk tidak mencukupi');
                    return;
                }
                selectedProducts[productId].quantity++;
            } else {
                selectedProducts[productId] = { 
                    id: productId, 
                    name: productName, 
                    price: productPrice, 
                    quantity: 1,
                    stock: productStock
                };
            }

            renderSelectedProducts();
        });
    });

    function renderSelectedProducts() {
        // Reset container dan total harga
        selectedProductsContainer.innerHTML = '';
        totalHarga = 0;

        // Render ulang produk yang dipilih
        Object.values(selectedProducts).forEach(product => {
            const productTotal = product.price * product.quantity;
            totalHarga += productTotal;

            const productDiv = document.createElement('div');
            productDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-2', 'p-2', 'bg-gray-100', 'rounded');
            productDiv.innerHTML = `
                <input type="hidden" name="no_produk[]" value="${product.id}">
                <input type="hidden" name="qty[]" value="${product.quantity}">
                <input type="hidden" name="harga[]" value="${product.price}">
                <div>
                    <span class="font-semibold">${product.name}</span>
                    <span class="text-gray-600 ml-2">
                        (Rp ${product.price.toLocaleString()} x ${product.quantity})
                    </span>
                </div>
                <div class="flex items-center">
                    <button type="button" class=" text-red-500 hover:text-red-700 remove-product" data-id="${product.id}">🗑️</button>
                </div>
            `;
            selectedProductsContainer.appendChild(productDiv);
        });

        totalHargaSpan.textContent = totalHarga.toLocaleString();
        attachRemoveEvent();
    }

    function attachRemoveEvent() {
        const removeButtons = document.querySelectorAll('.remove-product');
        removeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.id;
                if (selectedProducts[productId]) {
                    delete selectedProducts[productId];
                    renderSelectedProducts();
                }
            });
        });
    }

    function searchProducts() {
        var input, filter, items, name, i;
        input = document.getElementById('search');
        filter = input.value.toLowerCase();
        items = document.querySelectorAll('.product-item');
        
        for (i = 0; i < items.length; i++) {
            name = items[i].querySelector('h2').textContent || items[i].querySelector('h2').innerText;
            if (name.toLowerCase().indexOf(filter) > -1) {
                items[i].style.display = "";
            } else {
                items[i].style.display = "none";
            }
        }
    }
});
</script>
</body>
</html>
