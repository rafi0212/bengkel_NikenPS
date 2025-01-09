<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = ['id_transaksi', 'no_produk'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'no_produk',
        'nama_produk',
        'qty',
        'harga',
        'sub_total'
    ];

    public function getKeyName()
    {
        return ['id_transaksi', 'no_produk'];
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'no_produk', 'no_produk');
    }
}