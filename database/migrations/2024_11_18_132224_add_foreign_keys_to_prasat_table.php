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
        Schema::table('prasat', function (Blueprint $table) {
            $table->foreign(['peminjaman_id'])->references(['id'])->on('peminjaman')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['pengajuan_id'])->references(['id'])->on('pengajuan')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prasat', function (Blueprint $table) {
            $table->dropForeign('prasat_peminjaman_id_foreign');
            $table->dropForeign('prasat_pengajuan_id_foreign');
        });
    }
};
