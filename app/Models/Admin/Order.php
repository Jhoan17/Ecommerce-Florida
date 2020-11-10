<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ComboCustomer;
use App\Models\Admin\Customer;


class Order extends Model
{
	protected $fillable = ['order_number', 'order_security_code', 'order_price', 'order_state_id', 'municipality_id', 'order_delivery_address', 'order_delivery_date', 'order_delivery_time', 'customer_id', 'user_id'];
    protected $primaryKey = 'order_id';
 

    public function combosCustomers()
    {
        return $this->hasMany(ComboCustomer::class, 'order_id');
    }

    public function orderState()
    {
        return $this->belongsTo(OrderState::class, 'order_state_id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
