<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Detail_transaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DetailTransaksiController extends Controller
{
    public function show($id_transaksi)
    {
        $transaksi = Transaksi::with('detailTransaksi')->findOrFail($id_transaksi);

        // Calculate the total of all products (sub_total) in the transaction
        $total_harga = $transaksi->detailTransaksi->sum('sub_total');
        
        // Use the servis value stored in the transaction
        $service_fee = $transaksi->servis;

        // Total to be paid includes the products' total plus the service fee
        $total_to_be_paid = $total_harga + $service_fee;

        return view('kasir.detail_transaksi_lihat', compact('transaksi', 'service_fee', 'total_to_be_paid'));
    }

    public function tambah($id_transaksi)
    {
        $products = Produk::all();
        $transaksi = Transaksi::findOrFail($id_transaksi);
        return view('kasir.detail_transaksi_tambah', compact('products', 'transaksi'));
    }

    

    public function tambahDetailProduk(Request $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'no_produk' => 'required|array',
            'qty' => 'required|array',
            'harga' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validatedData['no_produk'] as $key => $no_produk) {
                $produk = Produk::findOrFail($no_produk);
                $sub_total = $validatedData['qty'][$key] * $validatedData['harga'][$key];

                Detail_transaksi::create([
                    'id_transaksi' => $validatedData['id_transaksi'],
                    'no_produk' => $no_produk,
                    'nama_produk' => $produk->nama_produk,
                    'qty' => $validatedData['qty'][$key],
                    'harga' => $validatedData['harga'][$key],
                    'sub_total' => $sub_total,
                ]);

                $produk->decrement('stok', $validatedData['qty'][$key]);
            }

            DB::commit();
            $this->updateTotalHarga($validatedData['id_transaksi']);

            return redirect()->route('kasir.detail.show', $validatedData['id_transaksi'])
                ->with('success', 'Detail transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan detail transaksi: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal menambahkan detail transaksi')
                ->withInput();
        }
    }

        public function edit($id_transaksi, $no_produk)
        {
            $transaksi = Transaksi::findOrFail($id_transaksi);
            $detail_transaksi = Detail_transaksi::where('id_transaksi', $id_transaksi)
                                                ->where('no_produk', $no_produk)
                                                ->firstOrFail();

                // Get the product details to fetch harga
            $produk = Produk::findOrFail($detail_transaksi->no_produk);

            return view('kasir.detail_transaksi_ubah', compact('transaksi', 'detail_transaksi', 'produk'));
        }


        public function update(Request $request, $id_transaksi, $no_produk)
        {
            // Validasi input
            $request->validate([
                'no_produk' => 'required|exists:products,no_produk',
                'qty' => 'required|integer|min:1',
            ]);
        
            // Cari detail transaksi yang akan diubah
            $detailProduk = Detail_Transaksi::where('id_transaksi', $id_transaksi)
                                            ->where('no_produk', $no_produk)
                                            ->firstOrFail();
        
            // Ambil data produk berdasarkan no_produk yang dipilih
            $produk = Produk::where('no_produk', $request->no_produk)->first();
        
            // Menghitung subtotal
            $harga = $produk->harga;  // Mengambil harga produk yang dipilih
            $qty = $request->qty;
            $subTotal = $harga * $qty ;
        
            // Update detail produk dengan nama produk baru
            $detailProduk->update([
                'no_produk' => $request->no_produk,
                'nama_produk' => $produk->nama_produk,  // Update nama produk
                'qty' => $qty,
                'harga' => $harga,
                'sub_total' => $subTotal,
            ]);
        
            return redirect()->route('kasir.detail.show', $id_transaksi)
                             ->with('success', 'Detail transaksi berhasil diperbarui.');
        }
        

        private function updateTotalHarga($id_transaksi)
        {
            $transaksi = Transaksi::findOrFail($id_transaksi);
            $total = Detail_transaksi::where('id_transaksi', $id_transaksi)->sum('sub_total');
            $transaksi->update(['total_harga' => $total]);
        }

    public function hapusProdukDetailTransaksi($id_transaksi, $no_produk)
    {
       // Menghapus detail transaksi berdasarkan id_transaksi dan no_produk
            Detail_Transaksi::where('id_transaksi', $id_transaksi)
            ->where('no_produk', $no_produk)
            ->delete();

        return redirect()->route('kasir.detail.show', $id_transaksi)
            ->with('success', 'Detail transaksi berhasil dihapus.');
    }


    public function cetak($id_transaksi)
{
    $transaksi = Transaksi::with('detailTransaksi')->findOrFail($id_transaksi);

    $total_harga = $transaksi->detailTransaksi->sum('sub_total');
    $service_fee = $transaksi->servis;
    $total_to_be_paid = $total_harga + $service_fee;

    return view('kasir.cetak_transaksi', compact('transaksi', 'total_harga', 'service_fee', 'total_to_be_paid'));
}

    }
