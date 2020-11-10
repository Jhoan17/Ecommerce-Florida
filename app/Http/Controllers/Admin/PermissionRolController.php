<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Rol;
use App\Models\Admin\Permission;

class PermissionRolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::orderBy('rol_id')->pluck('rol_name', 'rol_id')->toArray();
        $permissions = Permission::orderBy("created_at","DESC")->get();
        $permissionsRols = Permission::with('rols')->get()->pluck('rols', 'permission_id')->toArray();
        // dd($permissionsRols);

        return view('admin.permission-rol.index', compact('rols', 'permissions', 'permissionsRols'));
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            cache()->tags('permission')->flush();
            $permissions = new Permission();
            if ($request->input('state') == 1) {
                $permissions->find($request->input('permission_id'))->rols()->attach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El permisio se asigno correctamente al rol']);
            } else {
                $permissions->find($request->input('permission_id'))->rols()->detach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El permisio se elimino correctamente al rol']);
            }
        } else {
            abort(404);
        }
    }


}
