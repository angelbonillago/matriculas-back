<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{
    use HasRoles;

    /**
     * Display a listing of the resource.
     */

    public function asignarRol($idUsuario,$nombreRol)
    {
        $usuario = User::find($idUsuario);

        // Verifica si el usuario y el rol existen
         if ($usuario && $rol = Role::where('name', $nombreRol)->first()) {
            // Asigna el rol al usuario
            $usuario->assignRole($rol);

            return response()->json([
                'msg' => 'Rol asignado correctamente al usuario.',
            ]);
        } else {
            return response()->json([
                'msg' => 'Usuario o rol no encontrado.',
            ], 404); // 404 Not Found
        } 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $usuario = Auth::user();
            $usuario->load('roles'); // Carga la relación de roles
            return response()->json([
                'data' => [
                    'user' => $usuario,
                    'role' => $usuario->roles->pluck('name')->implode(','), // Obtén los nombres de los roles
                ],
                'msg' => 'Inicio de sesión exitoso'
            ]);
        } else {
            // Autenticación fallida
            return response()->json([
                'msg' => 'Credenciales incorrectas. Inténtalo de nuevo.',
            ], 401); // 401 Unauthorized
        }
    }
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input = $request->input();
        $input["password"] = Hash::make($request->password);
        $estudiante = User::create($input);
        return response()->json([
            'data' => $estudiante,
            'msg' => 'successfully registered User'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $estudiante = User::find($id);

        //return $estudiante;
        if (isset($estudiante)) {
            $msg = "Encontrado con exito";
        } else {
            $msg = "No Encontrado";
        }

        return response()->json([
            'data' => $estudiante,
            'msg' => $msg
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $estudiante = User::find($id);

        //return $estudiante;
        if (isset($estudiante)) {
            //update
            $estudiante->first_name = $request->first_name;
            $estudiante->last_name = $request->last_name;
            $estudiante->email = $request->email;
            $estudiante->password = Hash::make($request->password);
            if ($estudiante->save()) {
                $msg = "Success updating";
            } else {
                $msg = "The User was not updated.";
            }
        } else {
            $msg = "Error updating";
        }
        return response()->json([
            'data' => $estudiante,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $estudiante = User::find($id);

        //return $User;
        if (isset($estudiante)) {
            $respuesta = User::destroy($id);
            if ($respuesta) {

                $msg = "Usuario eliminado con exito";
            } else {
                $msg = "Error al intentar eliminar";
            }
        } else {
            $msg = "Usuario no Encontrado";
        }

        return response()->json([
            'data' => $estudiante,
            'msg' => $msg
        ]);
    }
}
