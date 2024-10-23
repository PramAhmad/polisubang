<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class MenuPermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'permission_id',
        'alias'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
