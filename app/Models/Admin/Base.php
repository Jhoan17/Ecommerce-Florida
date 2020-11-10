<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\BaseImage;
use App\Models\Admin\Combo;

class Base extends Model
{
	protected $fillable = ['base_name', 'base_measure', 'base_colors', 'base_customization', 'base_description', 'base_price', 'base_state'];
    protected $primaryKey = 'base_id';

    public function baseImages()
    {
        return $this->hasMany(BaseImage::class, 'base_id');
    }

    public function combos()
    {
        return $this->hasMany(Combo::class, 'base_id');
    }    
}
