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
            $table->dropForeign(['peminjaman_id']);
            $table->dropForeign(['pengajuan_id']);
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prasat', function (Blueprint $table) {
            $table->dropForeign(['peminjaman_id']);
            $table->dropForeign(['pengajuan_id']);
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan');
        });
    }
};
