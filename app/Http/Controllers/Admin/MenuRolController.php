<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Rol;
use App\Models\Admin\Menu;

class MenuRolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::orderBy('rol_id')->pluck('rol_name', 'rol_id')->toArray();
        $menus = Menu::getMenu();
        $menusRols = Menu::with('rols')->get()->pluck('rols', 'menu_id')->toArray();
        // dd($menusRols);

        return view('admin.menu-rol.index', compact('rols', 'menus', 'menusRols'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $menus = new Menu();
            if ($request->input('state') == 1) {
                $menus->find($request->input('menu_id'))->rols()->attach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se asigno correctamente']);
            } else {
                $menus->find($request->input('menu_id'))->rols()->detach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se elimino correctamente']);
            }
        } else {
            abort(404);
        }
    }
}
