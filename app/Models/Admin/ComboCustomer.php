<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ComboImage;
use App\Models\Admin\ComboType;
use App\Models\Admin\Base;
use App\Models\Admin\Product;
use App\Models\Admin\Order;

class ComboCustomer extends Model
{
	protected $fillable = ['combo_id', 'combo_name', 'combo_type_id', 'base_id', 'combo_description', 'order_id', 'combo_purchase_price', 'combo_price_percentage', 'combo_sale_price'];
    protected $primaryKey = 'combo_customer_id';
  	protected $table = 'combos_customers';

    public function comboType()
    {
        return $this->belongsTo(ComboType::class, 'combo_type_id');
    }

    public function ComboCustomerOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }   

    public function base()
    {
        return $this->belongsTo(Base::class, 'base_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'combo_products_customer', 'combo_customer_id', 'product_id' )->withPivot('color', 'flavor', 'recipe', 'customization_text', 'customization_image');
    }
}
