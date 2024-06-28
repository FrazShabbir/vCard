<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;
    public function platform()
    {
        return $this->belongsTo(SocialPlatform::class, 'social_platform_id');
    }
}
