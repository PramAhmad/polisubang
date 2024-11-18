<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prasat extends Model
{
    protected $table = 'prasat';
    protected $fillable = ['nama_prasat', 'alamat', 'no_telp','pengajuan_id','peminjaman_id','type'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    // barang by prasat
    public function barangByPrasat()
    {
        return $this->hasMany(BarangByPrasat::class);
    }

    public function pengajuanBarangLainya()
    {
        return $this->hasMany(PengajuanBarangLainya::class);
    }
    
}
