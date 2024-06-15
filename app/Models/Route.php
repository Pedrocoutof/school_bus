<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'route_location', 'route_id', 'location_id')->withPivot('order')->withTimestamps();
    }
}
