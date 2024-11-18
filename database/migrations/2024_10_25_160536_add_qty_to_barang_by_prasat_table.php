<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyToBarangByPrasatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_by_prasat', function (Blueprint $table) {
            $table->integer('qty')->after('barang_id')->default(1); // Menambahkan kolom qty
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_by_prasat', function (Blueprint $table) {
            $table->dropColumn('qty'); // Menghapus kolom qty jika rollback
        });
    }
}
