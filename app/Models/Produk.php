<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'products'; // Tabel di database
    protected $primaryKey = 'no_produk'; // Kolom primary key
    public $incrementing = false; // Primary key bukan auto increment
    protected $keyType = 'string'; // Tipe primary key string

    protected $fillable = [
        'no_produk',
        'kode_kategori',
        'nama_produk',
        'gambar_produk',
        'stok',
        'harga',
    ];


    // Relasi dengan tabel kategori (optional)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
    // Relasi dengan detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'no_produk', 'no_produk');
    }
}
