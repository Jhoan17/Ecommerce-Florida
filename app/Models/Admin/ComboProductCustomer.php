<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ComboProductCustomer extends Model
{
	protected $table = "combo_products_customer";
   	protected $fillable = ['combo_customer_id', 'product_id', 'color', 'flavor', 'recipe', 'customization_text', 'customization_image'];
    protected $primaryKey = 'combo_product_customer_id';
}
