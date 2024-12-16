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
        return view('kasir.transaksi_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|integer|unique:transaksi,id_transaksi',
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|string|max:25',
        ]);

        // Menyimpan transaksi
    $transaksi = Transaksi::create($request->all());

    // Redirect ke halaman detail transaksi setelah transaksi berhasil disimpan
    return redirect()->route('kasir.transaksi.index', ['id_transaksi' => $transaksi->id_transaksi])
                     ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
{
    // Gunakan 'id_transaksi' jika itu adalah nama kolom yang benar
    $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail(); 

    return view('kasir.transaksi_edit', compact('transaksi'));
}


    public function update(Request $request, $id_transaksi)
    {
        // Validasi input
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|string|max:25',
        ]);

        // Temukan transaksi berdasarkan id_transaksi
        $transaksi = Transaksi::findOrFail($id_transaksi);

        // Perbarui transaksi dengan data dari form
        $transaksi->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil diubah.');
    }

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();
        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
