<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental_detail extends Model
{
    use HasFactory;
    public function accessory(){
        return $this->belongsTo(Accessory::class);
    }
    public function rental(){
        return $this->belongsTo(Rental::class);
    }
}
