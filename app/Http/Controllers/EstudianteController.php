<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input = $request->input();
        $estudiante = Estudiante::create($input);
        return response()->json([
            'data' => $estudiante,
            'msg' => 'successfully registered student'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $estudiante = Estudiante::find($id);

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //=
        $estudiante = Estudiante::find($id);

        //return $estudiante;
        if (isset($estudiante)) {
            //update
            $estudiante->first_name = $request->first_name;
            $estudiante->last_name = $request->last_name;
            $estudiante->photo = $request->photo;
            if ($estudiante->save()) {
                $msg = "Success updating";
            } else {
                $msg = "The student was not updated.";
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

        $estudiante = Estudiante::find($id);

        //return $estudiante;
        if (isset($estudiante)) {
            $respuesta = Estudiante::destroy($id);
            if($respuesta){

                $msg = "Estudiante eliminado con exito";
            }else{
                $msg = "Error al intentar eliminar";
            }

        } else {
            $msg = "Estudiante no Encontrado";
        }

        return response()->json([
            'data' => $estudiante,
            'msg' => $msg
        ]);
    }
}
