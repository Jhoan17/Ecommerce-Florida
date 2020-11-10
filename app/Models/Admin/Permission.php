<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['permission_name', 'permission_slug'];
    protected $primaryKey = 'permission_id';

    public function rols()
    {
        return $this->belongsToMany(Rol::class, 'permission_rols', 'permission_id', 'rol_id');
    }
}
