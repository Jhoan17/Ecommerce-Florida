<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Base;
use App\Models\Admin\BaseImage;
use App\Http\Requests\ValidationBaseImage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class BaseImageController extends Controller
{

    public function create(Base $base)
    {
        can('base-image-create');
        return view('admin.base-image.create', compact('base'));
    }

    public function store(ValidationBaseImage $request)
    {
        $base_images = $request->file('base_image');
        $uploadcount = 0;
        // dd($base_images);

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

            BaseImage::create($request->all());

            $uploadcount++;
        }
        return redirect('admin/base')->with('message', 'Imagen agregada con exito');
    }

    public function edit($base_image_id)
    {
        can('base-image-edit');
        $image_base = BaseImage::findOrFail($base_image_id);
        $base_image_name = $image_base->base_image_name;
        $base = BaseImage::where('base_image_id', $base_image_id)->with('base')->first();
        return view('admin.base-image.edit', compact('base', 'base_image_name', 'base_image_id'));
    }

    public function update(Request $request, $base_image_id)
    {
        $image_base = BaseImage::findOrFail($base_image_id);
        $rute = explode("/", $image_base->base_image_name);
        $name_image_delete = explode("?",$rute[5]);

        if($name_image = BaseImage::setImage($request->base_image, $name_image_delete[0]))
        $request->request->add(['base_name_image' => $name_image]);

        BaseImage::where('base_image_id', $base_image_id)
            ->update(['base_image_name' => $name_image]);

        return redirect('admin/base')->with('message', 'Imagen de la base fue cambiada con exito');
    }

    public function destroy($base_image_id)
    {

        $image_base = BaseImage::findOrFail($base_image_id);
        $rute = explode("/", $image_base->base_image_name);
        $name_image_delete = explode("?",$rute[5]);

        $deletedRows = BaseImage::where('base_image_id', $base_image_id)->delete();
        Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/bases/".$name_image_delete[0]);
        return redirect('admin/base/')->with('message', 'Imagen de la base eliminada con exito');

    }
}
