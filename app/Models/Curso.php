<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;
    public $table = "curso";
    //protected $fillable = array("*");
    protected $fillable = [
        'name',
        'number_of_hours'
    ];

    public function estudiantes() //Un curso pertenece a muchos estudiantes
    {
        return $this->BelongsToMany(Estudiante::class, "curso_estudiante");
    }
}
