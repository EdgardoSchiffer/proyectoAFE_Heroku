<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental_user extends Model
{
    use HasFactory;

    public function rentals(){
        return $this->hasMany(Rental::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
