<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Location extends Model
{
    use HasFactory, HasSpatial;

    protected $casts = [
        'coordinates' => Point::class
    ];
    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'route_location', 'location_id', 'route_id')->withPivot('order')->withTimestamps();
    }

}
