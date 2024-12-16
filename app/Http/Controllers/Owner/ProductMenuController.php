<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ProductMenuController extends Controller
{
    // Menampilkan halaman produk
    public function index()
    {
        $products = Produk::with('kategori')->paginate(10);

        return view('Owner.productread', compact('products'));
    }

    // Menampilkan form untuk tambah produk
    public function create()
    {
        // Fetch all categories from the 'kategori' table
        $categories = Kategori::all();
        
        // Pass categories to the view
        return view('Owner.productcreate', compact('categories'));
    }

    // Menyimpan data produk baru
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'no_produk' => 'required|unique:products,no_produk|max:15',
            'kode_kategori' => 'required|exists:kategori,kode_kategori',
            'nama_produk' => 'required|max:35',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:5242880',  // Batas ukuran gambar 5MB
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ], [
            'no_produk.required' => 'Nomor produk wajib diisi.',
            'kode_kategori.exists' => 'Kategori tidak valid.',
            'gambar_produk.image' => 'File harus berupa gambar.',
            'gambar_produk.max' => 'Ukuran gambar maksimal 5MB.',  // Pesan kustom untuk gambar terlalu besar
        ]);

        // Menyimpan gambar ke folder public/images dan mendapatkan path gambar
        $path = $request->file('gambar_produk')->store('images', 'public');  // Menyimpan di folder public/images

        // Simpan produk dengan gambar
        Produk::create([
            'no_produk' => $request->no_produk,
            'kode_kategori' => $request->kode_kategori,
            'nama_produk' => $request->nama_produk,
            'gambar_produk' => $path,  // Menyimpan path gambar
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        $categories = Kategori::all();  // Fetch all categories

        return view('Owner.productedit', compact('product', 'categories'));
    }

    // Mengupdate data produk
    public function update(Request $request, $no_produk)
    
    {
    // Validasi form
    $request->validate([
        'nama_produk' => 'required|max:255',
        'kode_kategori' => 'required',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
        'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5242880', // Batas ukuran 5MB
    ]);

    // Temukan produk berdasarkan no_produk
    $product = Produk::findOrFail($no_produk);

    // Menyimpan gambar baru jika ada
    if ($request->hasFile('gambar_produk')) {
        // Hapus gambar lama jika ada
        if ($product->gambar_produk && file_exists(storage_path('app/public/' . $product->gambar_produk))) {
            unlink(storage_path('app/public/' . $product->gambar_produk));
        }

        // Simpan gambar baru
        $path = $request->file('gambar_produk')->store('images', 'public');
        $product->gambar_produk = $path;
    }

    // Update produk lainnya
    $product->update([
        'nama_produk' => $request->nama_produk,
        'kode_kategori' => $request->kode_kategori,
        'stok' => $request->stok,
        'harga' => $request->harga,
    ]);

    return redirect()->route('productmenu.index')->with('success', 'Produk berhasil diperbarui.');
    }


    // Menghapus produk
    public function destroy($no_produk)
    {
        $product = Produk::findOrFail($no_produk);

        // Menghapus gambar dari storage jika ada
        if ($product->gambar_produk) {
            Storage::delete('public/' . $product->gambar_produk);
        }

        $product->delete();

        return redirect()->route('productmenu.index')->with('success', 'Produk berhasil dihapus.');
    }
}
