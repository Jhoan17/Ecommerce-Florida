<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Combo;
use App\Models\Admin\ComboImage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class ComboImageController extends Controller
{

    public function create(combo $combo)
    {
        can('combo-image-create');
        return view('admin.combo-image.create', compact('combo'));
    }

    public function store(Request $request)
    {
        $combo_images = $request->file('combo_image');
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

            ComboImage::create($request->all());

            $uploadcount++;
        }
        return redirect('admin/combo')->with('message', 'Imagen agregada con exito');
    }

    public function edit($combo_image_id)
    {

        can('combo-image-edit');
        $image_combo = ComboImage::findOrFail($combo_image_id);
        $combo_image_name = $image_combo->combo_image_name;
        $combo = ComboImage::where('combo_image_name', $combo_image_name)->with('combo')->first();
        return view('admin.combo-image.edit', compact('combo', 'combo_image_name', 'combo_image_id'));
    }

    public function update(Request $request, $combo_image_id)
    {

        $image_combo = ComboImage::findOrFail($combo_image_id);
        $rute = explode("/", $image_combo->combo_image_name);
        $name_image_delete = explode("?",$rute[5]);

        if($name_image = ComboImage::setImage($request->combo_image, $name_image_delete[0]))
        $request->request->add(['combo_name_image' => $name_image]);

        ComboImage::where('combo_image_id', $combo_image_id)
            ->update(['combo_image_name' => $name_image]);

        return redirect('admin/combo')->with('message', 'Imagen de la combo fue cambiada con exito');
    }

    public function destroy($combo_image_id)
    {
        $image_combo = ComboImage::findOrFail($combo_image_id);
        $rute = explode("/", $image_combo->combo_image_name);
        $name_image_delete = explode("?",$rute[5]);

        $deletedRows = comboImage::where('combo_image_id', $combo_image_id)->delete();
        Storage::disk('dropbox')->getDriver()->getAdapter()->getClient()->delete("images/combos/".$name_image_delete[0]);
        return redirect('admin/combo/')->with('message', 'Imagen de la combo eliminada con exito');

    }
}
