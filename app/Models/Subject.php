<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id'];

    //Relación muchos a uno

    public function course(){

        return $this->belongsTo(Course::class);
    }


    //Relación Muchos a Muchos
    public function users(){
        
        return $this->belongsToMany(User::class);
    }

    //Relación uno a muchos

    public function notes(){

        return $this->hasMany(Note::class);
    }

    public function exams(){

        return $this->belongsToMany(Exam::class);

    } 
}