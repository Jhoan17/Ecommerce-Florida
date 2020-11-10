<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationPermission extends FormRequest
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
            'permission_name' => 'required|unique:permissions,permission_name,'. $this->route('permission_id').',permission_id',
            'permission_slug' => 'required|unique:permissions,permission_slug,'. $this->route('permission_id').',permission_id',
        ];
    }
    public function messages(){
        return[
            'permission_name.required' => 'Por favor escriba el nombre del permiso',
            'permission_name.unique' => 'El nombre de permiso ya esta asignado',
            'permission_slug.required' => 'Por favor escriba el slug del permiso',
            'permission_slug.unique' => 'El slug ya esta asignado',
        ];
    }
}
