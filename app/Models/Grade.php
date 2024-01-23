<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)

    public function subject(){

        return $this->belongsTo('App\Models\Subject');
    }

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    

}