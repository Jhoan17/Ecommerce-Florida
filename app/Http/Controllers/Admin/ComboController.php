<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationCombo;
use App\Models\Admin\Product;
use App\Models\Admin\Combo;
use App\Models\Admin\ComboImage;
use App\Models\Admin\ComboProduct;
use App\Models\Admin\ComboType;
use App\Models\Admin\Base;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;
use DB;




class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $combos = Combo::orderBy('created_at', 'DESC')->with('comboImages','comboType','base','products')->get();
        return view('admin.combo.index', compact('combos', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('combo-create');
        $combo_types = ComboType::orderBy('created_at', 'DESC')->get();
        $products = Product::where('product_state', 'active')->orderBy('created_at', 'DESC')->with('productCategory')->get();
        $bases = Base::orderBy('created_at', 'DESC')->get();
        return view('admin.combo.create', compact('combo_types','products','bases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationCombo $request)
    {

        // if(isset($request->state)){
        //     $request->request->add(['combo_state' => 'active']);

        // }else{
        //     $request->request->add(['combo_state' => 'desactive']);
        // }

        $request->request->add(['user_id' => 1]);

        $manyToMany = array();
        for ( $i=0 ; $i< count($request->product_id); $i++ )
        {
            $manyToMany[ $request->product_id[$i] ] = ['units' => $request->units[$request->product_id[$i]]];
        }

        $combo = Combo::create($request->all());
        $combo->products()->sync($manyToMany);

        $combos = Combo::all()->last();
        $combo_id = $combos->combo_id;

        $combo_images = $request->file('combo_image');

        if ($combo_images==NULL) {

        }else{

            $uploadcount = 0;

            foreach($combo_images as $combo_image)
            {
                $image_name = Str::random(50) . '.jpg';
                $imagen[] = Image::make($combo_image)->encode('jpg', 75);
                $images_names[] = $image_name;

                Storage::disk('dropbox')->put("images/combos/$images_names[$uploadcount]", $imagen[$uploadcount]->stream());
                $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
                $response = $dropbox->createSharedLinkWithSettings("images/combos/$images_names[$uploadcount]", ["requested_visibility"=>"public"]);
                $ruta[] = str_replace('dl=0', 'raw=1', $response['url']);

                $request->request->add(['combo_image_name' => $ruta[$uploadcount]]);
                $request->request->add(['combo_id' => $combo_id]);

                ComboImage::create($request->all());

                $uploadcount++;
            }
        }


        return redirect('admin/combo')->with('message', 'Combo creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {

        return view('admin.combo.show', compact('combo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($combo_id)
    {

        can('combo-edit');
        $combo_types = ComboType::orderBy('created_at', 'DESC')->get();
        $products = Product::where('product_state', 'active')->orderBy('created_at', 'DESC')->with('productCategory')->get();
        $bases = Base::orderBy('created_at', 'DESC')->get();
        $combo = Combo::with('comboImages','comboType','base','products')->find($combo_id);

        $combo_products = [];
        $combo_units = [];
        foreach ($combo->products as $product) {
            $combo_products[] = $product->product_id;
            $combo_units[$product->product_id] = $product->pivot->units;
        }

        // dd($combo_units);
        return view('admin.combo.edit', compact('combo_types','products','bases','combo','combo_products','combo_units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationCombo $request, $combo_id)
    {
        Combo::findOrFail($combo_id)->update($request->all());
        $combo_products = ComboProduct::where("combo_id", "=", $combo_id)->get();
        // dd($combo_products);
        foreach ($combo_products as $combo_product) {
            ComboProduct::destroy($combo_product->combo_product_id);
        }

        for ( $i=0 ; $i< count($request->product_id); $i++ )
        {

            DB::table('combo_products')->insert(
                ['combo_id' => $combo_id, 'product_id' => $request->product_id[$i], 'units' => $request->units[$request->product_id[$i]]]
            );
        }

        return redirect('admin/combo/')->with('message', 'Combo editado correctamente');
    }

    public function state($combo_id)
    {
       if($_GET['combo_state'] == 'active'){

            $combo = combo::find($combo_id);
            $combo->combo_state = 'desactive';
            $combo->save();
            return redirect('admin/combo/')->with('message', 'combo desactivado correctamente');

       }else{

            $combo = combo::find($combo_id);
            $combo->combo_state = 'active';
            $combo->save();
            return redirect('admin/combo/')->with('message', 'combo activado correctamente');

       }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($combo_id)
    {
        can('combo-destroy');
        $combo =  Combo::findOrFail($combo_id);

        $deleteCount = 0;

        foreach ($combo->comboImages as $combo_image) {
            $rute[] = explode("/", $combo_image->combo_image_name);
            $name_image_delete[] = explode("?",$rute[$deleteCount][5]);

            Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/combos/".$name_image_delete[$deleteCount][0]);
            ComboImage::destroy($combo_image->combo_image_id);

            $deleteCount++;
        }

        combo::destroy($combo_id);
        return redirect('admin/combo/')->with('message', 'combo eliminado correctamente');
    }
}
