<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Produk::paginate(10);
        $transaksi = Transaksi::paginate(10);
    
        // Ambil data total penjualan (total amount of transactions per month)
        $salesData = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
    
        // Ambil data total produk (total products per month)
        $productsData = Produk::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
    
        // Ambil data total cash flow (sum of total_harga from all transactions per month)
        $cashFlowData = Transaksi::selectRaw('MONTH(created_at) as month, SUM(total_harga) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
    
        // Pastikan setiap bulan ada data (isi dengan 0 jika tidak ada data)
        $salesData = $salesData->pad(12, 0);  // 12 months in a year, padding missing months with 0
        $productsData = $productsData->pad(12, 0);
        $cashFlowData = $cashFlowData->pad(12, 0);
    
        // Kirim data ke tampilan Blade
        return view('owner.dashboard', compact('salesData', 'productsData', 'cashFlowData', 'transaksi', 'products'));
    }
    


    public function Owner()
    {
        // Controller
        $products = Produk::paginate(10);
        $transaksi = Transaksi::paginate(10);  // Ambil 10 produk per halaman
        return view('Owner.dashboard', compact('products','transaksi'));
    }

    public function kasir()
    {
        // Ambil data transaksi
        $transaksi = Transaksi::all();

        // Kirim data ke view
        return view('kasir.transaksi_read', compact('transaksi'));
    }
}
