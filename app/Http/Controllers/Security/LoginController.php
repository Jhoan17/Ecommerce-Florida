<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\ForgotPassword;
use App\Models\Security\User;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/desk';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('security.index');
    }

    protected function authenticated(Request $request, $user)
    {
        $rol = $user->rol()->get();
        $notification = $user->notifications()->where("read_at",NULL)->get();
        // dd($user->user_state);
        
        if ($rol->isNotEmpty()) {

            if($user->user_state == "active"){

                $user->setSession($notification);

            }else{

                $this->guard()->logout();
                $request->session()->invalidate();
                return redirect('/')->withErrors(['error' => 'Este usuario no esta activo']);
                
            }
            
            // dd($user->setSession($rol));  
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/')->withErrors(['error' => 'Este usuario no tiene un rol activo']);
        }
    }

    public function username()
    {
        return 'user_id_card';
    }

    public function forgotPassword(){

        return view('security.forgot-password');
    }

    public function sendPasswordNew(request $request){

        $user = User::where("user_email",$request->email)->first();

        if($user == null){

            return redirect('security/forgot-password')->withErrors(['error' => 'Este correo no existe en nuesta base de datos']);

        }else{

            $passwordNew = Str::random(10);

            DB::table('users')
                            ->where('user_id', $user->user_id)
                            ->update(['password' => bcrypt($passwordNew)]);


            $receivers = $request->email;

            Mail::to($receivers)->send(new ForgotPassword($user->user_id, $passwordNew));
            return redirect('/')->with('message', 'La contraseña nueva se ha enviado a tu correo');
        }
        
    }
    
}
