<?php

use App\Models\Admin\Permission;

if (!function_exists('getMenuActive')) {
    function getMenuActive($ruta)
    {
        if (request()->is($ruta) || request()->is($ruta . '/*')) {
            return 'active';
        } else {
            return '';
        }
    }
}

if (!function_exists('canUser')) {
    function can($permission, $redirect = true)
    {
        if (session()->get('rol_name') == 'root') {
            return true;
        } else {
            $rolId = session()->get('rol_id');
            $permissions = cache()->tags('permission')->rememberForever("permission.rolid.$rolId", function () {
                return Permission::whereHas('rols', function ($query) {
                    $query->where('rols.rol_id', session()->get('rol_id'));
                })->get()->pluck('permission_slug')->toArray();
            });
            // dd($permissions);
            if (!in_array($permission, $permissions)) {
                if ($redirect) {
                    if (!request()->ajax())
                        return redirect()->route('admin')->with('error', 'No tienes permiso para entrar en este modulo')->send();
                    abort(403, 'No tiene permission');
                } else {
                    return false;
                }
            }
            return true;
        }
    }
}
