<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    //Relación uno a uno
    public function course(){

        return $this->belongsTo(Course::class);
    }

    public function subject(){

        return $this->belongsTo(Subject::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
