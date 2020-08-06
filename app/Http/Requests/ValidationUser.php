<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //luz verde soldado para iniciar validacion con el servidor o base de datos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() //en esta funcion se colocan los campos requeridos en el formulario
    {
        return [

              "user_name"=>"required",
              "user_surname"=>"required",
              "user_id_card"=>"numeric|required",
              "user_phone"=>"numeric|nullable",
              "user_email"=>"required",
              "user_birth_date"=>"required",
              "user_gender"=>"required",
              "rol_id"=>"required",
        ];
    }

    public function messages()
    {
      return[

        "user_name.required"=>"Por favor escriba el nombre del usuario",
        "user_surname.required"=>"Por favor escriba el apellido del usuario",
        "user_id_card.required"=>"Por favor escriba el numero de identificacion del usuario",
        "user_id_card.numeric"=>"El campo Identificacion solo recibe numeros",
        "user_phone.numeric"=>"El campo Telefono solo recibe numeros",
        "user_email.required"=>"Por favor escriba el E-mail del usuario",
        "user_birth_date.required"=>"Por favor escriba la fecha de nacimiento del usuario",
        "user_gender.required"=>"Por favor seleccione el genero del usuario",
        "rol_id.required"=>"Por favor seleccione el rol del usuario",
      ];
    }
}
