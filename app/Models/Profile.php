<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $guarded = [];
    use HasFactory;
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function primaryaddress()
    {
        return $this->hasOne(Address::class)->where('is_primary', 1);
    }

    public function customlinks()
    {
        return $this->hasMany(SocialLink::class)->where('social_platform_id',8);
    }
}
