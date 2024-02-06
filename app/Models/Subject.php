<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)

    public function course(){

        return $this->belongsTo(Course::class);
    }


    //Relación uno a muchos

    public function note(){

        return $this->hasMany(Note::class);
    }

        //Relación Muchos a Muchos

    public function user(){
        
        return $this->belongsToMany(User::class);
    }
    
    
}