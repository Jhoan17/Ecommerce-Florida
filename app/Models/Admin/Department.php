<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name'];
    protected $primaryKey = 'department_id';

    public function municipalities()
    {
    	return $this->hasMany(Combo::class, 'department_id');
    }
}
