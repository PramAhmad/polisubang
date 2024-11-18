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
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->index('peminjaman_user_id_foreign');
            $table->unsignedBigInteger('matakuliah_id')->index('peminjaman_matakuliah_id_foreign');
            $table->string('code');
            $table->string('name');
            $table->date('jadwal');
            $table->string('npm')->nullable();
            $table->string('type', 200);
            $table->enum('status', ['pending', 'approved', 'rejected']);
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
