<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    public function location()
    {
        return $this->belongsTo(Geolocation::class,'geolocation_id');
    }
}
