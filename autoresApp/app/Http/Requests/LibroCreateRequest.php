<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibroCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    function attributes() {
        return [
            'nombre'  => 'nombre del libro',
            'paginas'    => 'paginas del libro',
            'codLibro'      => 'codigo del libro',
            'precio' => 'precio del libro',
            'editorial' => 'editorial del libro',
            'img' =>'imagen del libro'
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
        $numeric = 'El campo :attribute debe ser numérico';
        $gte = 'El campo :attribute debe ser mayor o igual que :value';
        $integer = 'El campo :attribute ha de ser un número entero';
        $lte = 'El campo :attribute debe ser menor o igual que :value';
        
        return [
            'nombrerequired' =>$required,
            'nombre.max' => $max,
            'nombre.min' => $min,
            'nombre.unique' =>$unique,
            'paginas.required' =>$required,
            'paginas.integer' =>$integer,
            'paginas.gte'=>$gte,
            'paginas.lte' =>$lte,
            'codLibro.required' =>$required,
            'codLibro.integer' =>$integer,
            'codLibro.gte'=>$gte,
            'codLibro.lte' =>$lte,
            'precio.required' => $required,
            'precio.numeric' =>$numeric,
            'editorial.required' =>$required,
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
            'nombre' => 'required|min:5|max:200|unique:libros,nombre',
            'paginas' => 'required|integer|gte:1|lte:999999',
            'codLibro' => 'required|integer|gte:1|lte:999999',
            'precio' => 'required|numeric',
            'editorial' => 'required',
        ];
    }
}
