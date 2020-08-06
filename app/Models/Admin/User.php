<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Rol;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class User extends Model
{
    protected $fillable = ['user_name', 'user_id_card', 'user_surname', 'user_email', 'user_phone', 'user_birth_date', 'user_gender', 'user_password', 'user_image_name', 'user_state', 'rol_id'];
    protected $primaryKey = 'user_id';

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }


    public static function setImage($user_image, $actual = false)
    {
        if ($user_image) {
            if ($actual) {
                Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/users/".$actual);
            }
            $imageName = Str::random(20) . '.jpg';

            $imagen = Image::make($user_image)->encode('jpg', 75);
            // $imagen->resize(65, 65, function ($constraint) {
            //     $constraint->upsize();
            // });

            Storage::disk('dropbox')->put("images/users/$imageName", $imagen->stream());
            $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
            $response = $dropbox->createSharedLinkWithSettings("images/users/$imageName", ["requested_visibility"=>"public"]);
            return str_replace('dl=0', 'raw=1', $response['url']);
        } else {
            return false;
        }
    }
}
