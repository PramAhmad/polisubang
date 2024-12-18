<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarangLainya extends Model
{
    protected $table = 'peminjaman_barang_lainya';
    protected $guarded = [];

    public function prasat()
    {
        return $this->belongsTo(Prasat::class);
    }
}
