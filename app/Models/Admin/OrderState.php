<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{
	protected $table = 'order_states';
	protected $fillable = ['order_state_name'];
    protected $primaryKey = 'order_state_id';
    

    public function orders()
    {
    	return $this->hasMany(Combo::class, 'order_state_id');
    }
}
