<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("v1/estudiantes", EstudianteController::class);
Route::apiResource("v1/cursos", CursoController::class);
Route::apiResource("v1/usuarios", UsuarioController::class);

Route::post("v1/usuarios/login", [UsuarioController::class, 'login']);


//matriculas
Route::get("v1/cursos/cursomatriculado/{id}", [CursoController::class, 'cursomatriculado']);
Route::get("v1/cursos/cursonomatriculado/{id}", [CursoController::class, 'cursonomatriculado']);

Route::post("v1/cursos/matricularse", [CursoController::class, 'matricularse']);



