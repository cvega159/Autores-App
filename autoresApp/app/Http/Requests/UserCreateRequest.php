<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    function attributes() {
        return [
            'name'  => 'nombre de usuario',
            'email'    => 'correo de usuario',
            'password'      => 'clave de acceso',
            'oldpassword' => 'clave de acceso anterior',
            'rol' => 'rol del usuario',
            
        ];
    }
    
    public function authorize()
    {
        return true;
    }
    
    function messages() {
        $required = 'El campo :attribute es obligatorio';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $unique   = 'El campo :attribute debe ser único en la tabla de lugares';
        $email = 'El email no esta bien escrito';
        
        return [
            'name.required'     => $required,
            'name.max'          => $max,
            'name.min'          => $min,
            'name.unique'       => $unique,
            'email.required'     => $required,
            'email.max'          => $max,
            'email.min'          => $min,
            'email.unique'       => $unique,
            'email.email'        =>$email,
            'password.min'       =>$min,
            'rol.required'       =>$required,
            
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   =>'required|min:2|max:255|unique:users,name', 
            'email'     => 'required|email|min:5|max:255|unique:users,email|email:rfc',
            'password' => 'min:8|confirmed|',
            'rol' =>'required',
            
        ];
    }
}
