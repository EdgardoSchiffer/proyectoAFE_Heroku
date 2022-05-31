<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    public function vehicle_details(){
        return $this->hasMany(Vehicle_detail::class);
    }
    public function accessory_type(){
        return $this->belongsTo(Accessory_type::class);
    }
    public function rental_details(){
        return $this->hasMany(Rental_detail::class);
    }
}
