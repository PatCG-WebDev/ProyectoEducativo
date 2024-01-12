<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

//Relación uno a muchos
    public function users(){

        return $this->hasMany('App\Models\User');
    
    }

    public function subject(){

        return $this->hasMany('App\Models\Subject');
    }


}