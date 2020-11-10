<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ComboType;
use App\Http\Requests\ValidationComboType;


class ComboTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=1;
        $combo_types = ComboType::orderBy('created_at', 'DESC')->get();
        return view('admin.combo-type.index', compact('combo_types','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('combo-type-create');
        return view('admin.combo-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationComboType $request)
    {
        ComboType::create($request->all());
        return redirect('admin/combo-type/create')->with('message', 'Tipo de combo creado con exito');
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
    public function edit($combo_type_id)
    {
        can('combo-type-edit');
        $combo_type = ComboType::findOrFail($combo_type_id);
        return view('admin.combo-type.edit', compact('combo_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationComboType $request, $combo_type_id)
    {
        ComboType::findOrFail($combo_type_id)->update($request->all());
        return redirect('admin/combo-type/')->with('message', 'Tipo de combo editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($combo_type_id)
    {
        can('combo-type-destroy');
        ComboType::destroy($combo_type_id);
        return redirect('admin/combo-type/')->with('message', 'Tipo de combo eliminado correctamente');
    }
}
