<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function fuel_type(){
        return $this->belongsTo(Fuel_type::class);
    }
    public function vehicle_type(){
        return $this->belongsTo(Vehicle_type::class);
    }
    public function galeries(){
        return $this->hasMany(Galery::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function vehicle_details(){
        return $this->hasMany(Vehicle_detail::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function rentals(){
        return $this->hasMany(Rental::class);
    }
}
