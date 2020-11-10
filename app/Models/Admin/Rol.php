<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\User;


class Rol extends Model
{
   	protected $fillable = ['rol_name'];
    protected $primaryKey = 'rol_id';
}
