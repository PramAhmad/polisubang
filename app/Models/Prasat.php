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
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
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
    // peminjaman barang lainya
    public function peminjaman_barang_lainya()  
    {
        return $this->hasMany(PeminjamanBarangLainya::class);
    }
    
}
