<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;
    
    public function devices()
    {
        return $this->hasMany(Device::class,'location_id');
    }
}
