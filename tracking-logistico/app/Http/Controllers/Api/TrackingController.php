<?php

namespace App\Http\Controllers\Api;

use App\Models\Shipment;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track($tracking_number)
    {
        $shipment = Shipment::with([
            'status',
            'location',
            'histories.location',
            'histories.status'
        ])->where('tracking_number', $tracking_number)->first();

        if (!$shipment) {
            return response()->json([
                'message' => 'Número de guía no encontrado, porfavor ingresalo nuevamente'
            ], 404);
        }

        return response()->json([
            'tracking_number' => $shipment->tracking_number,
            'status' => $shipment->status->name,
            'current_location' => $shipment->location->name,
            'recipient_employee' => $shipment->employee_name,
            'history' => $shipment->histories->map(function ($history) {
                return [
                    'date' => $history->created_at,
                    'location' => $history->location->name,
                    'status' => $history->status->name,
                    'comments' => $history->comments
                ];
            })
        ]);
    }
}