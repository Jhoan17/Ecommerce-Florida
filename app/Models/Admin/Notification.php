<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $fillable = ['notifiable_type', 'user_id', 'read_at'];
    protected $primaryKey = 'notifiable_id';

}
