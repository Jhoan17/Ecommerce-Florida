<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Security\User;
use App\Models\Admin\Rol;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ValidationUser;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $users = User::orderBy('created_at', 'DESC')->with('rol')->get();
        return view('admin.user.index', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('user-create');
        
        $rols=Rol::orderby('rol_id')->get();
        $genders=array(

          "male"=> "masculino",
          "female"=>"femenino",
          "undefined"=>"indefinido"

        );


        return view('admin.user.create', compact('rols', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationUser $request)
    {

        //dd($request->user_image);
        if ($request->user_image==null) {
            $request->request->add(['user_image_name'=>'https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1']);
        }else {
          if ($image_name=User::setImage($request->user_image));
          $request->request->add(['user_image_name'=>$image_name]);
        }

        if(isset($request->state)){
            $request->request->add(['user_state' => 'active']);

        }else{
            $request->request->add(['user_state' => 'desactive']);
        }

        $password=bcrypt(Str::random(20)); //-- Generador de password aleatoria encriptada
        $request->request->add(['user_password' => $password]);
        User::create($request->all());
        return redirect('admin/user/create')->with('message', 'Usario registrado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
      can('user-edit');
      
      $user = User::findOrFail($user_id);
      $rols=Rol::orderby('rol_id')->get();

      $genders=array(

        "male"=> "masculino",
        "female"=>"femenino",
        "undefined"=>"indefinido"

      );

      return view('admin.user.edit', compact('user','rols', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationUser $request, $user_id)
    {
      $user = User::findOrFail($user_id);
      //dd($request->file('user_image'));
      if($request->file('user_image') == NULL){

          $request->request->add(['user_image_name' => $user->user_image_name]);

        }else{
          //dd("hola");

          $rute = explode("/", $user->user_image_name); //explode sirve para: coger un string o cada que ve un / crea un arreglo
          //dd($rute);
          if($user->user_image_name=='https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1'){

              if($name_image = User::setImage($request->user_image))
              $request->request->add(['user_image_name' => $name_image]);
          }else{
          if (count($rute)==6) {
            //dd("hola");
              $name_image_delete = explode("?",$rute[5]);
              //https://www.dropbox.com/s/z2cguag9w9bz8y2/U16N0GXLFetsYOmrtbNa.jpg?raw=1
              if($name_image = User::setImage($request->user_image, $name_image_delete[0]))
              $request->request->add(['user_image_name' => $name_image]);
          }/*else{
              if($name_image = User::setImage($request->user_image))
              $request->request->add(['user_image_name' => $name_image]);
          }*/
        }
      }

      /*if(isset($request->state)){
          $request->request->add(['user_state' => 'active']);

      }else{
          $request->request->add(['user_state' => 'desactive']);
      }*/


      User::findOrFail($user_id)->update($request->all());
      return redirect('admin/user/')->with('message', 'Usuario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
      can("user-destroy");
      
      $user = User::findOrFail($user_id);
      $rute = explode("/", $user->user_image_name);
      $name_image_delete = explode("?",$rute[5]);

      //$count_user = count($user->combos);


      //if($count_user == 0){

        if ($user->user_image_name=='https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1') {
          User::destroy($user_id);
          return redirect('admin/user/')->with('message', 'Usuario eliminado correctamente');
        } else{
          Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/users/".$name_image_delete[0]);
          User::destroy($user_id);
          return redirect('admin/user/')->with('message', 'Usuario eliminado correctamente');
        }
    /*  }else{
          return redirect('admin/user/')->with('message', 'Este producto esta siendo utilizado');
      }*/
    }


public function state($user_id)
{
   if($_GET['user_state'] == 'active'){

        $user = User::find($user_id);
        $user->user_state = 'desactive';
        $user->save();
        return redirect('admin/user/')->with('message', 'Usuario desactivado correctamente');

   }else{

        $user = User::find($user_id);
        $user->user_state = 'active';
        $user->save();
        return redirect('admin/user/')->with('message', 'Usuario activado correctamente');

   }
}

public function editImage($user_id)
{
    $user = User::findOrFail($user_id);
    return view('admin.user.edit-image', compact('user'));
}

public function updateimage(Request $request, $user_id)
{
    $user = User::findOrFail($user_id);
    $rute = explode("/", $user->user_image_name);

    if ($user->user_image_name=='https://www.dropbox.com/s/9dg1mjzwzfetepo/default-user.png?raw=1') {
          if ($name_image = User::setImage($request->user_image))
              $request->request->add(['user_image_name' => $name_image]);
    }else{
        if (count($rute)==6) {
       $name_image_delete = explode("?",$rute[5]);
       if($name_image = User::setImage($request->user_image, $name_image_delete[0]))
        $request->request->add(['user_image_name' => $name_image]);
        //dd ($name_image_delete);
    }/*else{
        if($name_image = User::setImage($request->user_image))
        $request->request->add(['user_image_name' => $name_image]);
    }*/
    }
    $user->update($request->all());
    return redirect('admin/user')->with('message', 'Imagen del producto fue cambiada con exito');

    }
}
