<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Customer;


class Country extends Model
{
    protected $fillable = ['phone_code', 'name', 'nom', 'iso2', 'iso3'];
    protected $primaryKey = 'nombre';

    public function customers()
    {
    	return $this->hasMany(Customer::class, 'nombre');
    }
}
