<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductCategory;
use App\Http\Requests\ValidationProductCategory;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=1;
        $product_categorys = ProductCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.product-category.index', compact('product_categorys','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('product-category-create');
        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationProductCategory $request)
    {
        ProductCategory::create($request->all());
        return redirect('admin/product-category/create')->with('message', 'Categoria de producto creado con exito');
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
    public function edit($product_category_id)
    {
        can('product-category-edit');
        $product_category = productCategory::findOrFail($product_category_id);
        return view('admin.product-category.edit', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationProductCategory $request, $product_category_id)
    {
        ProductCategory::findOrFail($product_category_id)->update($request->all());
        return redirect('admin/product-category/')->with('message', 'Categoria de producto editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_category_id)
    {
        can('product-category-destroy');
        ProductCategory::destroy($product_category_id);
        return redirect('admin/product-category/')->with('message', 'Categoria de producto eliminado correctamente');
    }
}
