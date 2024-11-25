<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'produk';

    // Primary key tabel (jika berbeda dari 'id')
    protected $primaryKey = 'no_produk';

    // Tipe primary key (jika bukan incrementing integer)
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi secara massal
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
}
