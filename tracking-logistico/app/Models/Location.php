<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'city',
        'address',
    ];

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class, 'current_location_id');
    }
}
