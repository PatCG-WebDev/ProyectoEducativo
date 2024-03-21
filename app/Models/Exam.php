<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'subject_id',
    ];

    //Relación uno a uno
    public function notes(){

        return $this->hasMany(Note::class);
    }

    //Relación muchos a uno
    public function course(){

        return $this->belongsTo(Course::class);
    }

    public function subject(){

        return $this->belongsTo(Subject::class);
    }

}
