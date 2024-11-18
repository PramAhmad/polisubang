<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['expired', 'nama_barang', 'jumlah', 'tanggal_expired', 'kondisi', 'lokasi_barang','type'];


}
