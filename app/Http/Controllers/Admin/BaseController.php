<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationBase;
use App\Models\Admin\Base;
use App\Models\Admin\BaseImage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;



class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $bases = Base::orderBy('created_at', 'DESC')->with('baseImages')->get();
        return view('admin.base.index', compact('bases', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        can('base-create');
        return view('admin.base.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationBase $request)
    {
        $base_images = $request->file('base_image');

        if(!isset($request->base_customization)){
            $request->request->add(['base_customization' => '']);

        }
        Base::create($request->all());
        $bases = Base::all()->last();
        $base_id = $bases->base_id;

        if($base_images == NULL){

        }else{

            $uploadcount = 0;

            foreach($base_images as $base_image)
            {
                $image_name = Str::random(50) . '.jpg';
                $imagen[] = Image::make($base_image)->encode('jpg', 75);
                $images_names[] = $image_name;

                Storage::disk('dropbox')->put("images/bases/$images_names[$uploadcount]", $imagen[$uploadcount]->stream());
                $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
                $response = $dropbox->createSharedLinkWithSettings("images/bases/$images_names[$uploadcount]", ["requested_visibility"=>"public"]);
                $ruta[] = str_replace('dl=0', 'raw=1', $response['url']);

                $request->request->add(['base_image_name' => $ruta[$uploadcount]]);
                $request->request->add(['base_id' => $base_id]);

                BaseImage::create($request->all());

                $uploadcount++;
            }
        }

        return redirect('admin/base/create')->with('message', 'Base creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Base $base)
    {
        return view('admin.base.show', compact('base','image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($base_id)
    {
        can('base-edit');
        $base = Base::with('baseImages')->find($base_id);
        return view('admin.base.edit', compact('base'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $base_id)
    {
        if(isset($request->state)){
            $request->request->add(['base_state' => 'active']);

        }else{
            $request->request->add(['base_state' => 'desactive']);
        }
        if(!isset($request->base_customization)){
            $request->request->add(['base_customization' => '']);

        }

        Base::findOrFail($base_id)->update($request->all());
        return redirect('admin/base/')->with('message', 'Base editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($base_id)
    {
        can('base-destroy');
        $base = Base::findOrFail($base_id);
        $count_base = count($base->combos);

        if ($count_base==0) {

            $deleteCount = 0;

            foreach ($base->baseImages as $base_image) {
                $rute[] = explode("/", $base_image->base_image_name);
                $name_image_delete[] = explode("?",$rute[$deleteCount][5]);

                Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/bases/".$name_image_delete[$deleteCount][0]);

                BaseImage::destroy($base_image->base_image_id);
                $deleteCount++;
            }

            base::destroy($base_id);
            return redirect('admin/base/')->with('message', 'base eliminado correctamente');
        }else{
            return redirect('admin/base/')->with('message', 'Esta base esta siendo utilizada');
        }

    }

    public function state($base_id)
    {
       if($_GET['base_state'] == 'active'){

            $base = base::find($base_id);
            $base->base_state = 'desactive';
            $base->save();
            return redirect('admin/base/')->with('message', 'base desactivado correctamente');

       }else{

            $base = base::find($base_id);
            $base->base_state = 'active';
            $base->save();
            return redirect('admin/base/')->with('message', 'base activado correctamente');

       }
    }
}
