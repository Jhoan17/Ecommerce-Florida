<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use App\Models\Security\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where("user_id","=",session("user_id"))->get();
        $user = User::find(session("user_id"));

        $genders=array(

        "male"=> "masculino",
        "female"=>"femenino",
        "undefined"=>"indefinido"

        );

        return view('admin.profile.index', compact("orders","user","genders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile_id)
    {
        $user = User::findOrFail($profile_id);
        $request->request->add(['user_image_name' => $user->user_image_name]);
        User::findOrFail($profile_id)->update($request->all());
        return redirect('admin/profile/')->with('message', 'Tu perfil se edito correctamente');
    }

    public function updateImage(Request $request, $profile_id)
    {
        $user = User::findOrFail($profile_id);
        $rute = explode("/", $user->user_image_name);

        if (count($rute)==6) {
           $name_image_delete = explode("?",$rute[5]);
           if($name_image = User::setImage($request->user_image, $name_image_delete[0]))
            $request->request->add(['user_image_name' => $name_image]);
        }else{
            if($name_image = User::setImage($request->user_image))
            $request->request->add(['user_image_name' => $name_image]);  
        }

        $user->update($request->all());
        return redirect('admin/profile')->with('message', 'Imagen del profileo fue cambiada con exito'); 
    }


    public function changePassword(Request $request, $profile_id){
        $check = Hash::check($request->password, Auth::user()->password, []);
        if ($check == true) {

            if (strlen($request->new_password)>6) {

                if ($request->new_password == $request->confirm_new_password) {         

                    DB::table('users')
                        ->where('user_id', $profile_id)
                        ->update(['password' => bcrypt($request->new_password)]);

                    return redirect('admin/profile?password-changed')->with('message', 'La Contraseña se cambio correctamente');
                }else{
                    return redirect('admin/profile?password')->with('error', 'La Contraseña nueva no coincide');
                }

            }else{
                return redirect('admin/profile?password')->with('error', 'Contraseña debe de tener más de 6 caracteres'); 
            }


        }else{
            return redirect('admin/profile?password')->with('error', 'Contraseña actual incorrecta'); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
