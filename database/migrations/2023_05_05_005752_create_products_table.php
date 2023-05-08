<?php

use Brick\Math\BigInteger;
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
            $table->id();
            $table->string('nama');
            $table->string('spesifikasi');
            $table->BigInteger('harga_beli');
            $table->bigInteger('harga_jual')->nullable();
            $table->text('deskripsi')->nullable();
            $table->bigInteger('biaya_reparasi')->nullable();
            $table->date('tanggal_pembelian');
            $table->date('tanggal_penjualan')->nullable();
            $table->enum('kelengkapan', ['Unit Only', 'Fullset']);
            $table->string('link_gambar')->nullable();
            $table->boolean('is_sharing');
            $table->timestamps();
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
