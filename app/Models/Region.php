<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'code'];

    public function subRegions()
    {
        return $this->hasMany(SubRegion::class);
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

}
