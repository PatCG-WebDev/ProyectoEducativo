<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

//Relación uno a muchos
    public function users(){

        return $this->hasMany('App\Models\Users');
    
    }

    public function asignatura(){

        return $this->hasMany('App\Models\Asignatura');
    }


}
