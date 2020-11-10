<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Menu;
use App\Http\Requests\ValidationMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::getMenu();
        // dd($menus);
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationMenu $request)
    {
        // dd($request->all());
        $request->request->add(['menu_icon' => "fa-".$request->menu_iconfa]);
        Menu::create($request->all());
        return redirect('admin/menu/create')->with('message', 'Menú creado con exito');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationMenu $request, $menu_id)
    {
        $request->request->add(['menu_icon' => "fa-".$request->menu_iconfa]);
        Menu::findOrFail($menu_id)->update($request->all());
        return redirect('admin/menu')->with('message', 'Menú actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Menu::destroy($id);
        return redirect('admin/menu')->with('message', 'Menú eliminado con exito');
    }

    public function saveOrder(Request $request)
    {

        if ($request->ajax()) {
       
            $menu = new Menu;
            $menu->saveOrder($request->menu);
            return response()->json(['respuesta' => 'ok']);
        } else {
            abort(404);
        }
    }
}

