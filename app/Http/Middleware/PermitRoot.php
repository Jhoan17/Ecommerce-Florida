<?php

namespace App\Http\Middleware;

use Closure;

class PermitRoot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->permit())
        return $next($request);
        return redirect("/admin/desk")->with("error", "No tienes permiso para entrar a esta ruta");
    }

    private function permit(){
        return session()->get("rol_name") == 'root';
    }
}
