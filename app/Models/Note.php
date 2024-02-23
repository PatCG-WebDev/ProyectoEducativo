<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    protected $fillable = ['user_id', 'subject_id', 'exam_id', 'value', 'comment'];

    use HasFactory;

    //Relación muchos a uno
    public function subject(){

        return $this->belongsTo(Subject::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function exam(){

        return $this->belongsTo(Exam::class);
    }

}