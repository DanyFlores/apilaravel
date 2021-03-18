<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('getUsuarios',[UsuarioController::class,'index']); // http://localhost:8000/api/getUsuarios
Route::get('getUsuarios/{id}',[UsuarioController::class,'show']);
Route::delete('deleteUsuarios/{id}',[UsuarioController::class,'destroy']);
Route::post('usuario',[UsuarioController::class,'store']);
Route::put('usuario/{id}',[UsuarioController::class,'update']);

