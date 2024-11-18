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
            $table->foreign(['barang_id'])->references(['id'])->on('barang')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['prasat_id'])->references(['id'])->on('prasat')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_by_prasat', function (Blueprint $table) {
            $table->dropForeign('barang_by_prasat_barang_id_foreign');
            $table->dropForeign('barang_by_prasat_prasat_id_foreign');
        });
    }
};
