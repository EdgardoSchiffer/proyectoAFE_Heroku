<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory_type extends Model
{
    use HasFactory;
    public function accessories(){
        return $this->hasMany(Accessory::class);
    }
}
