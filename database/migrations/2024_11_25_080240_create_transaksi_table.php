<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi')->primary();;
            $table->date('tanggal_transaksi')->nullable();
            $table->string('nama_pelanggan', 15)->nullable();
            $table->string('Keterangan_Service', 15)->nullable();
            $table->decimal('total_harga', 25)->nullable();
            $table->decimal('servis', 35)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
