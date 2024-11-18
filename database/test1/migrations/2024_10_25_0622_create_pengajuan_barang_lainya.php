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
        Schema::create('pengajuan_barang_lainya', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('prasat_id');
            $table->string('nama_barang');
            $table->string('jumlah');
            $table->string('estimasi_harga');
            $table->string('gambar')->nullable();
            $table->foreign('prasat_id')->references('id')->on('prasat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barang_lainya');
    }
};
