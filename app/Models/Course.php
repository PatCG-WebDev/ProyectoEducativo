<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Relación uno a muchos
    public function subjects(){

        return $this->hasMany(Subject::class);
    }

    public function exams(){

        return $this->hasMany(Exam::class);

    }

    //Relación muchos a muchos
    public function users(){

        return $this->belongsToMany(User::class);

    }
}