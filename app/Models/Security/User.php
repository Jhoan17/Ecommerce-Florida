<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\Rol;
use App\Models\Admin\Order;
use App\Models\Admin\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $fillable = ['user_name', 'user_id_card', 'user_surname', 'user_email_verified_at', 'user_email', 'user_phone', 'user_birth_date', 'user_gender', 'password', 'user_image_name', 'user_state', 'rol_id'];
    protected $primaryKey = 'user_id';

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }



    public function setSession($notification)
    {

        Session::put([
            'user_id' => $this->user_id,
            'user_image_name' => $this->user_image_name,
            'user_name' => $this->user_name,
            'rol_id' => $this->rol_id,
            'rol_name' => $this->rol->rol_name,
            // 'count_notification' => count($notification),
        ]);
        // if (count($notification) == 1) {
        //     Session::put(
        //         [
        //             'notifiable_type' => $notification[0]['notifiable_type'],
        //             'created_at' => $notification[0]['created_at'],
        //         ]
        //     );
        // } else {
        //     Session::put('notification', $notification);
        // }

    }


    public static function setImage($user_image, $actual = false)
    {
        if ($user_image) {
            if ($actual) {
                if ($actual != "default-user.png") {
                     Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/users/".$actual);
                }
               
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
