<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = ['user_id', 'matakuliah_id', 'code', 'name', 'jadwal', 'npm', 'type', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function prasat()
    {
        return $this->hasMany(Prasat::class);
    }


}
