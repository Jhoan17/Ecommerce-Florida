<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
	protected $fillable = ['municipality_name', 'municipality_state', 'department_id'];
    protected $primaryKey = 'municipality_id';

    public function orders()
    {
    	return $this->hasMany(Combo::class, 'municipality_id');
    }

    public function department()
    {
    	return $this->hasMany(Combo::class, 'department_id');
    }
}
