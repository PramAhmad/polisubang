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
        Schema::create('peminjaman_barang_lainya', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('prasat_id');
            $table->string('nama_barang');
            $table->string('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_lainya');
    }
};
