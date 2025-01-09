<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class KasirTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('kasir.transaksi', compact('transaksi'));
    }

    public function create()
    {
        return view('kasir.transaksi_read');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_transaksi' => 'required|integer|unique:transaksi,id_transaksi',
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:50',
            'Keterangan_Service' => 'required|string|max:50',
            'servis' => 'required|numeric',
            'total_harga' => 'required|numeric',

        ]);

       
        // Simpan data ke database
        $transaksi = Transaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nama_pelanggan' => $request->nama_pelanggan,
            'Keterangan_Service' => $request->Keterangan_Service,
            'servis' => $request->servis,
            'total_harga' => $request->total_harga,
        ]);        
        
        return redirect()->route('kasir.detail.tambah', ['id_transaksi' => $transaksi->id_transaksi])
        ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Gunakan 'id_transaksi' jika itu adalah nama kolom yang benar
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

        return view('kasir.transaksi_edit', compact('transaksi'));
    }


            // Update Method
        public function update(Request $request, $id_transaksi)
        {
            // Validasi input
            $request->validate([
                'tanggal_transaksi' => 'required|date',
                'nama_pelanggan' => 'required|string|max:50',
                'Keterangan_Service' => 'required|string|max:50',
                'servis' => 'required|numeric',
                'total_harga' => 'required|numeric',
            ]);

            // Temukan transaksi berdasarkan ID
            $transaksi = Transaksi::findOrFail($id_transaksi);

            // Update transaksi dengan data yang diterima
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'nama_pelanggan' => $request->nama_pelanggan,
                'Keterangan_Service' => $request->Keterangan_Service, // Pastikan ini sesuai
                'servis' => $request->servis,
                'total_harga' => $request->total_harga,
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
        }

    


    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    public function history()
    {
        $transaksi = Transaksi::all();
        return view('kasir.transaksi', compact('transaksi'));
    }
}
