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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('matakuliah_id');
            $table->string('code');
            $table->string('name');
            $table->date('jadwal');
            $table->string('npm')->nullable();
            $table->enum('type', ['dosen', 'mahasiswa']);
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
