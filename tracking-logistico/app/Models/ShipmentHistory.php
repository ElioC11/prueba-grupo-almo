<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentHistory extends Model
{
    protected $fillable = [
        'shipment_id',
        'location_id',
        'status_id',
        'comments',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ShipmentStatus::class, 'status_id');
    }

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
