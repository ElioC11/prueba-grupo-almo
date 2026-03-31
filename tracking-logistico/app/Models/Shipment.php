<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'status_id',
        'current_location_id',
        'employee_name'
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(ShipmentHistory::class, 'shipment_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ShipmentStatus::class, 'status_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'current_location_id');
    }
}
