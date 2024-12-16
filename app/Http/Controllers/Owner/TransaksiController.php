<?php

namespace App\Http\Controllers\Owner;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        // Mengambil transaksi dengan pagination
        $transaksi = Transaksi::paginate(10);
        return view('Owner.transaksiread', compact('transaksi'));
    }

    // Menampilkan form untuk membuat transaksi baru
    public function create()
    {
        return view('Owner.transaksi.create');
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_transaksi' => 'required|string|unique:transaksi,id_transaksi',
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|numeric',
        ]);

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        return view('Owner.transaksi.edit', compact('transaksi'));
    }

    // Mengupdate transaksi yang sudah ada
    public function update(Request $request, $id_transaksi)
    {
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'nama_pelanggan' => 'required|string|max:15',
            'total_harga' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Menghapus transaksi
    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Ekspor data transaksi ke file Excel
    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }

    // Ekspor data transaksi ke file PDF
    public function exportPdf()
    {
        $transaksi = Transaksi::all();
        $pdf = Pdf::loadView('Owner.transaksi-pdf', compact('transaksi'));
        return $pdf->download('transaksi.pdf');
    }
}
