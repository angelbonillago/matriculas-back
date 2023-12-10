<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Curso::all();
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
        $curso = Curso::create($input);
        return response()->json([
            'data' => $curso,
            'msg' => 'successfully registered curso'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $curso = Curso::find($id);

        //return $curso;
        if (isset($curso)) {
            $msg = "Encontrado con exito";
        } else {
            $msg = "No Encontrado";
        }

        return response()->json([
            'data' => $curso,
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
        //Request $request
        $curso = Curso::find($id);

        //return $curso;
        if (isset($curso)) {
            //update
            $curso->name = $request->name;
            $curso->number_of_hours = $request->number_of_hours;
            if ($curso->save()) {
                $msg = "Success updating";
            } else {
                $msg = "The student was not updated.";
            }
        } else {
            $msg = "Error updating";
        }
        return response()->json([
            'data' => $curso,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $curso = Curso::find($id);

        //return $curso;
        if (isset($curso)) {
            $respuesta = Curso::destroy($id);
            if ($respuesta) {

                $msg = "Curso eliminado con exito";
            } else {
                $msg = "Error al intentar eliminar";
            }
        } else {
            $msg = "Curso no Encontrado";
        }

        return response()->json([
            'data' => $curso,
            'msg' => $msg
        ]);
    }

    public function matricularse(Request $request)
    {

        $input = $request->input();
        $cursos_ids = ($input["curso_id"]);
        $userlogueado = ($input["estudiante_id"]);
        $estudiante = Estudiante::where('user_id', $userlogueado)->first();


        if (is_array($cursos_ids) && $estudiante) {
            $estudiante_id = $estudiante->id;
            foreach ($cursos_ids as $curso_id) {
                // Insertar cada curso en la tabla intermedia
                DB::table('curso_estudiante')->insert([
                    'curso_id' => $curso_id,
                    'estudiante_id' => $estudiante_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['msg' => 'Matriculación exitosa']);
        } else {
            // Manejar el caso en que $cursos_ids no es un array
            return response()->json(['msg' => 'Error en los datos enviados'], 400);
        }
    }

    public function cursomatriculado($idUserMatriculado)
    {

        // Obtén los IDs de los cursos matriculados por el estudiante
        $idsCursosMatriculados = DB::table('curso_estudiante')
            ->where('estudiante_id', $idUserMatriculado)
            ->pluck('curso_id')
            ->toArray();

        $cursosMatriculados = Curso::whereIn('id', $idsCursosMatriculados)->get();


        return $cursosMatriculados->toArray();
    }


    public function cursonomatriculado($idUserMatriculado)
    {

        // Obtén los IDs de los cursos matriculados por el estudiante
        $idsCursosMatriculados = DB::table('curso_estudiante')
            ->where('estudiante_id', $idUserMatriculado)
            ->pluck('curso_id')
            ->toArray();


        //$cursosMatriculados = Curso::whereIn('id', $idsCursosMatriculados)->get();
        $cursosNoMatriculados = Curso::whereNotIn('id', $idsCursosMatriculados)->get();


        return $cursosNoMatriculados->toArray();
    }
}
