<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    
//Relación uno a muchos
public function users(){

    return $this->hasMany('App\Models\User');

}





}


