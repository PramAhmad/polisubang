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
        Schema::table('peminjaman_barang_lainya', function (Blueprint $table) {
            $table->string('estimasi_harga')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_barang_lainya', function (Blueprint $table) {
            $table->dropColumn('estimasi_harga');
            $table->dropColumn('gambar');
        });
    }
};
