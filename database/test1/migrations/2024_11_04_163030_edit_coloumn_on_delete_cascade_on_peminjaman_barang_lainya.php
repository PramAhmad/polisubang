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
        Schema::table('pengajuan_barang_lainya', function (Blueprint $table) {
                $table->dropForeign(['prasat_id']);
            $table->foreign('prasat_id')->references('id')->on('prasat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_barang_lainya', function (Blueprint $table) {
            $table->dropForeign(['prasat_id']);
            $table->foreign('prasat_id')->references('id')->on('prasat');
        });
    }
};
