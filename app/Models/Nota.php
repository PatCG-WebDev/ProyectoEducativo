<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)

    public function asignatura(){

        return $this->belongsTo('App\Models\Asignatura');
    }

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    

}
