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
        Schema::table('pengajuan', function (Blueprint $table) {
        //  drop status
            $table->dropColumn('status');
            $table->enum('status',['pending','approved','reject'])->default('pending')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('status',['pending','approved','rejected'])->default('pending')->after('id');
        });
    }
};
