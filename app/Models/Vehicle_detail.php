<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_detail extends Model
{
    use HasFactory;
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function accessory(){
        return $this->belongsTo(Accessory::class);
    }
}
