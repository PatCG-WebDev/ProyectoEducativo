<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    
//Relación uno a muchos
public function users(){

    return $this->hasMany(User::class);

}
}


