<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductMenuController extends Controller
{
    // Menampilkan halaman produk
    public function index()
    {
        $products = Produk::with('kategori')->paginate(10); // Menampilkan 10 data per halaman
        return view('superadmin.productread', compact('products'));
    }

    // Menampilkan form untuk tambah produk
    public function create()
    {
        return view('superadmin.productcreate');
    }

    // Menyimpan data produk baru
    public function store(Request $request)
    {
        $request->validate([
            'no_produk' => 'required|unique:produk,no_produk|max:15',
            'kode_kategori' => 'required',
            'nama_produk' => 'required|max:35',
            'gambar_produk' => 'required|image|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $gambarPath = $request->file('gambar_produk')->store('produk', 'public');

        Produk::create([
            'no_produk' => $request->no_produk,
            'kode_kategori' => $request->kode_kategori,
            'nama_produk' => $request->nama_produk,
            'gambar_produk' => $gambarPath,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        return view('superadmin.productedit', compact('product'));
    }

    // Mengupdate data produk
    public function update(Request $request, $id)
    {
        $product = Produk::findOrFail($id);

        $request->validate([
            'kode_kategori' => 'required',
            'nama_produk' => 'required|max:35',
            'gambar_produk' => 'nullable|image|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        if ($request->hasFile('gambar_produk')) {
            $gambarPath = $request->file('gambar_produk')->store('produk', 'public');
            $product->gambar_produk = $gambarPath;
        }

        $product->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Produk::findOrFail($id);
        $product->delete();

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil dihapus.');
    }
}
