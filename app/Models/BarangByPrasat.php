<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangByPrasat extends Model
{
    protected $table = 'barang_by_prasat';
    protected $fillable = ['barang_id', 'prasat_id','qty'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
