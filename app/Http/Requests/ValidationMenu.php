<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidationInputUrl;



class ValidationMenu extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'menu_name' => 'required|max:50|unique:menus,menu_name,'. $this->route('menu_id').',menu_id',
            'menu_url' => ['required','max:50', new ValidationInputUrl],
            'menu_icon' => 'nullable|max:50'
        ];
    }
    public function messages(){
        return[
            'menu_name.required' => 'Por favor escriba el nombre del menu',
            'menu_name.max' => 'El nombre del menu no puede sobrepasar los 50 caracteres',
            'menu_name.unique' => 'El nombre del menu ya existe',
            'menu_url.required' => 'Por favor escriba la url del menu',
        ];
    }
}
