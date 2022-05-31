<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function rentals(){
        return $this->hasMany(Rental::class);
    }
    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
