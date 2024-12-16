<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    public $incrementing = false; // Menonaktifkan auto increment
    protected $primaryKey = null; 
    protected $table = 'detail_transaksi';
    
    protected $fillable = [
        'id_transaksi',
        'no_produk',
        'nama_produk',
        'qty',
        'harga',
        'sub_total',
    ];

    // Relasi dengan model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi dengan model Produk
    public function product()
    {
        return $this->belongsTo(Produk::class, 'no_produk', 'no_produk');
    }
}
