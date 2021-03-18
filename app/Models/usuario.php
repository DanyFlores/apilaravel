<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    public static $rulesPost = [
        'nombre'        => 'required|max:100|min:3',
        'correo'        => 'required',
        'contrasenia'    =>  'required|min:5'
    ];

    public static $rulesPostMessages = [
        'nombre.required'       => 'El campo nombre es requerido',
        'nombre.max'            => 'El campo nombre no puede ser mayor a :max caracteres',
        'nombre.min'            => 'El campo nombre no puede ser menor a :min caracteres',

        'correo.required'       => 'El correo es requerido',

        'contrasenia.required'            => 'El password es requerida',
        'contrasenia.min'                => 'El password no debe ser menor a :min caracteres'
    ];
    
    protected $fillable = [
        'nombre',
        'correo',
        'contrasenia',
        'activo',
        'usercreated',
        'usermodified',
        'created_at',
        'updated_at'        
    ];

    protected $hidden = [
        'usercreated',
        'usermodified',
        'created_at',
        'updated_at'
    ];
    

}
