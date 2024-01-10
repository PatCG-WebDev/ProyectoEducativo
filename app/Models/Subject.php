<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)

    public function course(){

        return $this->belongsTo('App\Models\Course');
    }


    //Relación uno a muchos

    public function note(){

        return $this->hasMany('App\Models\Note');
    }

        //Relación Muchos a Muchos

    public function user(){
        
        return $this->belongsToMany('App\Models\User');
    }
    
    
}