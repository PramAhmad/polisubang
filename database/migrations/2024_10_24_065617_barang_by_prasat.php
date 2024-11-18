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
        Schema::create('barang_by_prasat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('prasat_id');
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('prasat_id')->references('id')->on('prasat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_by_prasat');
    }
};
