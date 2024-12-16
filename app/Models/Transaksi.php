<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan nama konvensional
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi'; 

    // Tentukan kolom mana yang bisa diisi menggunakan mass-assignment
    protected $fillable = [
        'id_transaksi',
        'tanggal_transaksi',
        'nama_pelanggan',
        'total_harga'
    ];

    // Jika tidak menggunakan auto increment pada id
    public $incrementing = false;

    // Tentukan tipe data untuk kolom id_transaksi
    protected $keyType = 'integer';

    // Tentukan format tanggal yang digunakan pada kolom tanggal_transaksi
    protected $dates = [
        'tanggal_transaksi',
    ];
    
    // Relasi dengan detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
