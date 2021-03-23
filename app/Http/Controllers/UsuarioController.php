<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = usuario::select('id','nombre','correo','contrasenia')
        ->get();
        return response($usuarios,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $validator = Validator::make($request->all(),usuario::$rulesPost,usuario::$rulesPostMessages);
        if($validator->fails())
            return response()->json($validator->errors(),422);
        DB::beginTransaction();
        try {
            $equipo = new usuario();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $usuarios = usuario::select('id','nombre','correo','contrasenia')
        ->where('id',$id)
        ->get();
        return response($usuarios,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),usuario::$rulesPut,usuario::$rulesPutMessages);
        if($validator->fails())
            return response()->json($validator->errors(),422);
        
            DB::beginTransaction();
            try {
                $equipo = Usuario::find($id);
                $request->request->add(['usermodified'=>'sys@admin']);
                $equipo->fill($request->all());
                $equipo->save();
                DB::commit();
                return response()->json(['message' => 'OK'],200);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['message' => 'Error'],422);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = usuario::find($id);
        $usuario->activo = false;
        $usuario->save();
        return response($usuario,200);        
    }
}
