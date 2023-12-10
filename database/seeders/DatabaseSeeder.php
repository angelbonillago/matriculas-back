<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
/*         \App\Models\Estudiante::factory(15)->create();
        \App\Models\Curso::factory(15)->create()->each(function($curso){  //para añadirle datos a la tabla estudiante_curso y tenga relaciones.
            $curso->estudiantes()->sync(
                Estudiante::all()->random(3)
            );
        }); */

        


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
