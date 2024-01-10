<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)

    public function curso(){

        return $this->belongsTo('App\Models\Curso');
    }


    //Relación uno a muchos

    public function nota(){

        return $this->hasMany('App\Models\Nota');
    }

        //Relación Muchos a Muchos

    public function user(){
        
        return $this->belongsToMany('App\Models\User');
    }
    
    
}
