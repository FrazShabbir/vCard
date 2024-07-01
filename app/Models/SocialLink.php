<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialLink extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function platform()
    {
        return $this->belongsTo(SocialPlatform::class, 'social_platform_id');
    }
    public function shortlink()
    {
        return $this->belongsTo(ShortLink::class, 'short_link_id');
    }
}
