<?php

namespace App\Repositories\Usuario;

use Validator;
use App\Models\usuario;
use Illuminate\Support\Facades\DB;
use App\IRepositories\IBaseRepository;
use App\Contracts\Repositories\Usuario\IUsuarioRepository;

class UsuarioRepository implements IUsuarioRepository
{
    private $model;
    public function __construct()
    {
        $this->model =  new usuario();
    }   

    public function getAll(){
        $usuarios =  $this->model::select('id','nombre','correo','contrasenia')
        ->where('activo',1)
        ->get();
        return response($usuarios,200);
    }

    public function get($id){
        $usuarios =  $this->model::select('id','nombre','correo','contrasenia')
        ->where('id',$id)
        ->where('activo',1)
        ->get();
        return response($usuarios,200);
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(),$this->model::$rulesPost,$this->model::$rulesPostMessages);
        if($validator->fails())
            return response()->json($validator->errors(),422);      
        DB::beginTransaction();
        try {
            $equipo = $this->model;
            $equipo->nombre = $request->nombre;
            $equipo->correo = $request->correo;
            $equipo->contrasenia = $request->contrasenia;
            $equipo->usercreated = "sysadmin@gmail.com";
            $equipo->save();
            DB::commit();
            return response()->json(['message' => 'OK'],200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Error'],422);
        }   
    }
    public function update($request,$id)
    {
        $validator = Validator::make($request->all(),$this->model::$rulesPut,$this->model::$rulesPutMessages);
        if($validator->fails())
            return response()->json($validator->errors(),422);

            DB::beginTransaction();
            try {
                $equipo = $this->model::find($id);
                $equipo->usermodified = "sys@admin";
                // $request->request->add(['usermodified'=>'sys@admin']);
                $equipo->fill($request->all());
                $equipo->save();
                DB::commit();
                return response()->json(['message' => 'OK'],200);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['message' => 'Error'],422);
            }
    }
    public function delete($id)
    {
        $usuario = $this->model::find($id);
        $usuario->activo = false;
        $usuario->save();
        return response($usuario,200);
    }
}
