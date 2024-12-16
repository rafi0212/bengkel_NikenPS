<?php

// app/Http/Controllers/Kasir/DetailTransaksiController.php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Detail_Transaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    // Menampilkan detail transaksi
    public function show($id_transaksi)
    {
        $transaksi = Transaksi::with('detailTransaksi')->findOrFail($id_transaksi);
        return view('kasir.detail_transaksi_lihat', compact('transaksi'));
    }

    // Menampilkan halaman untuk menambah produk ke transaksi
    public function tambah($id_transaksi)
    {
         // Retrieve all products from the Produk model
    $products = Produk::all();
    
    // Retrieve the transaction based on the provided ID
    $transaksi = Transaksi::findOrFail($id_transaksi);
        
    return view('kasir.detail_transaksi_tambah', compact('products', 'transaksi'));
    }

    // Menambahkan detail produk ke transaksi
    public function tambahDetailProduk(Request $request, $id_transaksi)
{
    // Ensure selected_products is in the expected format (array of objects)
    $request->validate([
        'selected_products' => 'required|array',
        'selected_products.*.id' => 'required|exists:produk,no_produk',
        'selected_products.*.quantity' => 'required|integer|min:1',
        'service' => 'nullable|numeric|min:0',
    ]);

    $selectedProducts = json_decode($request->selected_products, true); // Decode the JSON string

    foreach ($selectedProducts as $product) {
        $produk = Produk::where('no_produk', $product['id'])->first();
        $sub_total = ($produk->harga * $product['quantity']) + ($request->service ?? 0);

        // Create a new Detail_Transaksi entry
        Detail_Transaksi::create([
            'id_transaksi' => $id_transaksi,
            'no_produk' => $product['id'],
            'nama_produk' => $produk->nama_produk,
            'qty' => $product['quantity'],
            'harga' => $produk->harga,
            'sub_total' => $sub_total,
            'service' => $request->service,
        ]);
    }

    // Redirect back with success message
    return redirect()->route('kasir.detail.show', $id_transaksi)
        ->with('success', 'Produk berhasil ditambahkan.');
}



    // Menampilkan halaman edit untuk detail produk
    public function edit($id_transaksi, $no_produk)
    {
        $detail = Detail_Transaksi::where('id_transaksi', $id_transaksi)
            ->where('no_produk', $no_produk)
            ->firstOrFail();
        return view('kasir.detail_transaksi_ubah', compact('detail', 'id_transaksi'));
    }

    // Memperbarui detail transaksi
    public function update(Request $request, $id_transaksi, $no_produk)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'service' => 'nullable|numeric|min:0',
        ]);

        $detail = Detail_Transaksi::where('id_transaksi', $id_transaksi)
            ->where('no_produk', $no_produk)
            ->firstOrFail();

        $sub_total = ($detail->harga * $request->qty) + ($request->service ?? 0);

        $detail->update([
            'qty' => $request->qty,
            'sub_total' => $sub_total,
            'service' => $request->service,
        ]);

        return redirect()->route('kasir.detail.show', $id_transaksi)
            ->with('success', 'Detail transaksi berhasil diperbarui.');
    }

    // Menghapus detail produk dari transaksi
    public function destroy($id_transaksi, $no_produk)
    {
        $detail = Detail_Transaksi::where('id_transaksi', $id_transaksi)
            ->where('no_produk', $no_produk)
            ->firstOrFail();
        $detail->delete();

        return redirect()->route('kasir.detail.show', $id_transaksi)
            ->with('success', 'Detail produk berhasil dihapus.');
    }
}
