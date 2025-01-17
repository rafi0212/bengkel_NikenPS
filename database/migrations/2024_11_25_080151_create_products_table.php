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
        Schema::create('products', function (Blueprint $table) {
            $table->string('no_produk', 15)->primary();
            $table->string('kode_kategori', 5);
            $table->string('nama_produk', 35)->nullable();
            $table->string('gambar_produk')->nullable();  
            $table->integer('stok')->nullable();
            $table->decimal('harga')->nullable();
            $table->timestamps();

            $table->foreign('kode_kategori')->references('kode_kategori')->on('kategori')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
