<?php

namespace App\Http\Controllers;
use App\Models\Produk; // Import model Product
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function Owner()
    {
            // Controller
        $products = Produk::paginate(10);  // Ambil 10 produk per halaman
        return view('Owner.dashboard', compact('products'));

    }

    public function kasir()
    {
        // Ambil data transaksi
        $transaksi = Transaksi::all();

        // Kirim data ke view
        return view('kasir.transaksi', compact('transaksi'));
    }
}
