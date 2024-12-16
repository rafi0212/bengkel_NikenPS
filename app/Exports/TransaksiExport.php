<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    // Ambil semua data transaksi
    public function collection()
    {
        return Transaksi::all(['id_transaksi', 'tanggal_transaksi', 'nama_pelanggan', 'total_harga']);
    }

    // Tambahkan header pada file Excel
    public function headings(): array
    {
        return ['ID Transaksi', 'Tanggal Transaksi', 'Nama Pelanggan', 'Total Harga'];
    }
}
