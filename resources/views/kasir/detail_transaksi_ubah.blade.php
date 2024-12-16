@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Detail Transaksi</h1>

    <form action="{{ route('kasir.transaksi.update', [$detail->id_transaksi, $detail->no_produk]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_produk" class="block text-gray-700 font-bold mb-2">Nama Produk</label>
            <input type="text" id="nama_produk" value="{{ $detail->nama_produk }}" class="border rounded w-full py-2 px-3 text-gray-700" readonly>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-gray-700 font-bold mb-2">Harga</label>
            <input type="text" id="harga" value="{{ number_format($detail->harga, 0, ',', '.') }}" class="border rounded w-full py-2 px-3 text-gray-700" readonly>
        </div>

        <div class="mb-4">
            <label for="qty" class="block text-gray-700 font-bold mb-2">Quantity</label>
            <input type="number" id="qty" name="qty" value="{{ $detail->qty }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            <a href="{{ route('kasir.transaksi.show', $detail->id_transaksi) }}" class="text-blue-500 hover:underline">Kembali</a>
        </div>
    </form>
</div>
@endsection
