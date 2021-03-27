<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\usuario;
use App\Repositories\Usuario\UsuarioRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Validator;

class UsuarioController extends Controller
{
    private $usuarioRepository;
    public function __construct(UsuarioRepository $usuario)
    {
        $this->usuarioRepository = $usuario;
    }


    public function index()
    {      
        return $this->usuarioRepository->getAll();       
        
    }

    public function store(Request $request)
    {    
        return $this->usuarioRepository->create($request);        
    }

    public function show($id)
    {
        return $this->usuarioRepository->get($id);
    }

    public function update(Request $request, $id)
    {
        return $this->usuarioRepository->update($request,$id);
    }

    public function destroy($id)
    {       
        return $this->usuarioRepository->delete($id);
    }
}
