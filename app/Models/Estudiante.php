<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $table="estudiante";
    //protected $fillable = array("*");
    protected $fillable = [
        'first_name',
        'last_name',
        'photo'
    ];

    public function cursos()  //el estudiante pertenece a muchos cursos
    {
        return $this->BelongsToMany(Estudiante::class, "curso_estudiante");
    }
}
