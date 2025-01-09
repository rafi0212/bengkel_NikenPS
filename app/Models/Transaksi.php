<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel
    protected $primaryKey = 'id_transaksi'; // Primary Key
    public $incrementing = false; // Primary key tidak auto-increment
    protected $keyType = 'integer'; // Tipe primary key
    protected $fillable = [
        'id_transaksi', 'tanggal_transaksi', 'nama_pelanggan', 'Keterangan_Service', 'servis', 'total_harga'
    ];

    // Relasi dengan detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
