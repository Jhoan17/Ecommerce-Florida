<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductCategory;
use App\Http\Requests\ValidationProduct;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $products = Product::orderBy('created_at', 'DESC')->with('productCategory')->get();
        $count_products = count($products);
        return view('admin.product.index', compact('products', 'count', 'count_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('product-create');
        $product_categorys=  ProductCategory::orderBy('product_category_id')->get();
        return view('admin.product.create', compact('product_categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationProduct $request)
    {

        if($request->product_image == null){

        }else{

            if($name_image = Product::setImage($request->product_image))
            $request->request->add(['product_image_name' => $name_image]);
        }

        if(isset($request->state)){
            $request->request->add(['product_state' => 'active']);

        }else{
            $request->request->add(['product_state' => 'desactive']);
        }

        if(isset($request->personalized)){

            if (count($request->personalized)==2) {
                $request->request->add(['product_customization' => 'text,image']);


            }else{

                $request->request->add(['product_customization' => $request->personalized[0]]);
                // dd($request->personalized[0]);
            }

        }

        $product = Product::create($request->all());
        $product->productCategory()->sync($request->product_category_id);
        return redirect('admin/product/create')->with('message', 'Producto creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        can('product-edit');
        $product = Product::with('productCategory')->find($product_id);
        // dd($product->productCategory[0]);
        $product_categorys=  ProductCategory::orderBy('product_category_id')->get();
        $product_customizations = explode(",",$product->product_customization);
        $modifiables = array(
            "1" => "Colores",
            "2" => "Sabores",
            "3" => "Recetas",
        );
        // dd($product_customizations);
        return view('admin.product.edit', compact('product','product_categorys','product_customizations','modifiables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationProduct $request, $product_id)
    {
        if($request->file('product_image') == NULL){

            $product = Product::findOrFail($product_id);
            $request->request->add(['product_image_name' => $product->product_image_name]);


        }else{

            $product = Product::findOrFail($product_id);
            $rute = explode("/", $product->product_image_name);

            if (count($rute)==6) {
                $name_image_delete = explode("?",$rute[5]);
                if($name_image = Product::setImage($request->product_image, $name_image_delete[0]))
                $request->request->add(['product_image_name' => $name_image]);
            }else{
                if($name_image = Product::setImage($request->product_image))
                $request->request->add(['product_image_name' => $name_image]);
            }

        }

        if(isset($request->state)){
            $request->request->add(['product_state' => 'active']);

        }else{
            $request->request->add(['product_state' => 'desactive']);
        }

        if(isset($request->personalized)){

            if (count($request->personalized)==2) {
                $request->request->add(['product_customization' => 'text,image']);


            }else{

                $request->request->add(['product_customization' => $request->personalized[0]]);
                // dd($request->personalized[0]);
            }

        }


        Product::findOrFail($product_id)->update($request->all());
        $product->productCategory()->sync($request->product_category_id);
        return redirect('admin/product/')->with('message', 'Producto editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        can('product-destroy');

        $product = Product::findOrFail($product_id);

        if($product->product_image_name != NULL){
            $rute = explode("/", $product->product_image_name);
            $name_image_delete = explode("?",$rute[5]);


            $count_product = count($product->combos);

            if($count_product == 0){

                Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/products/".$name_image_delete[0]);
                Product::destroy($product_id);
                return redirect('admin/product/')->with('message', 'Producto eliminado correctamente');

            }else{
                return redirect('admin/product/')->with('message', 'Este producto esta siendo utilizado');
            }
        }else{
            Product::destroy($product_id);
            return redirect('admin/product/')->with('message', 'Producto eliminado correctamente');
        }
    }

    public function state($product_id)
    {
       if($_GET['product_state'] == 'active'){

            $product = Product::find($product_id);
            $product->product_state = 'desactive';
            $product->save();
            return redirect('admin/product/')->with('message', 'Producto desactivado correctamente');

       }else{

            $product = Product::find($product_id);
            $product->product_state = 'active';
            $product->save();
            return redirect('admin/product/')->with('message', 'Producto activado correctamente');

       }
    }

    public function editImage($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.product.edit-image', compact('product'));
    }

    public function updateimage(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $rute = explode("/", $product->product_image_name);

        if (count($rute)==6) {
           $name_image_delete = explode("?",$rute[5]);
           if($name_image = Product::setImage($request->product_image, $name_image_delete[0]))
            $request->request->add(['product_image_name' => $name_image]);
        }else{
            if($name_image = Product::setImage($request->product_image))
            $request->request->add(['product_image_name' => $name_image]);
        }

        $product->update($request->all());
        return redirect('admin/product')->with('message', 'Imagen del producto fue cambiada con exito');
    }
}
