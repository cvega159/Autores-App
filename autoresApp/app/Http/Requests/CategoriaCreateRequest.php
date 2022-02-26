<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaCreateRequest extends FormRequest
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


    function attributes() {
        return [
            'nombreCategoria'  => 'nombre de la categoria',
        ];
    }
    
    function messages() {
        $required = 'El campo nombreCategoria es obligatorio';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $unique   = 'El campo :attribute debe ser único en la tabla de lugares';
        
        return [
            'nombreCategoria.required'     => $required,
            'nombreCategoria.max'          => $max,
            'nombreCategoria.min'          => $min,
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
            'nombreCategoria'=>'required|min:5|max:150|unique:categorias,nombreCategoria'
        ];
    }
}
