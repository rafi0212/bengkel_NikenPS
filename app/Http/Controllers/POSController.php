<?php

namespace App\Http\Controllers;


use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('coba', compact('products'));
    }
}
