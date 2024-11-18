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
            $table->bigIncrements('id');
            $table->timestamps();
            $table->enum('expired', ['Ya', 'Tidak']);
            $table->string('nama_barang');
            $table->enum('type', ['alat', 'bahan'])->default('alat');
            $table->string('jumlah');
            $table->date('tanggal_expired')->nullable();
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
