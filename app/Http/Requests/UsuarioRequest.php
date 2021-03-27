<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre'         => 'required|max:100|min:3',
            'correo'         => 'required',
            'contrasenia'    =>  'required|min:5'
        ];
    }
    public function messages(){
        return [
            'nombre.required'       => 'El campo nombre es requerido',
            'nombre.max'            => 'El campo nombre no puede ser mayor a :max caracteres',
            'nombre.min'            => 'El campo nombre no puede ser menor a :min caracteres',
    
            'correo.required'       => 'El correo es requerido',
    
            'contrasenia.required'            => 'El password es requerida',
            'contrasenia.min'                => 'El password no debe ser menor a :min caracteres'
        ];
    }
}
