<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    

    use SoftDeletes;
    protected $data = ['deleted_at'];

    protected $fillable = [
        
    ];
    
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
