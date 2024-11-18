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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('expired', ['Ya', 'Tidak']);
            $table->string('nama_barang');
            $table->string('jumlah');
            $table->date('tanggal_expired')->nullable();
            // kondisi barang
            $table->enum('kondisi', ['Baik', 'Rusak']);
            $table->string('lokasi_barang');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
