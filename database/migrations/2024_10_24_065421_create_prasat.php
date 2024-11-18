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
            $table->id();
            $table->uuid('uuid');
            $table->timestamps();
            $table->string('nama_prasat');
            // type
            $table->enum('type', ['pengajuan', 'peminjaman']);
            $table->unsignedBigInteger('peminjaman_id')->nullable();
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
            $table->unsignedBigInteger('pengajuan_id')->nullable();
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan');

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
