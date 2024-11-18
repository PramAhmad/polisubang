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
        Schema::create('prasat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nama_prasat');
            $table->enum('type', ['pengajuan', 'peminjaman']);
            $table->unsignedBigInteger('peminjaman_id')->nullable()->index('prasat_peminjaman_id_foreign');
            $table->unsignedBigInteger('pengajuan_id')->nullable()->index('prasat_pengajuan_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasat');
    }
};
