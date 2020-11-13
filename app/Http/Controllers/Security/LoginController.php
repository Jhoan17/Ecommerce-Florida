<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    
}
