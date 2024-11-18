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
        Schema::table('barang_by_prasat', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropForeign(['prasat_id']);
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('prasat_id')->references('id')->on('prasat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_by_prasat', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropForeign(['prasat_id']);
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('prasat_id')->references('id')->on('prasat');
        });
    }
};
