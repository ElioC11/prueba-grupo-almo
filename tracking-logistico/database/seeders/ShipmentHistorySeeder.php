<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ShipmentHistory;

class ShipmentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ShipmentHistory::create([
            'shipment_id' => 1,
            'location_id' => 1,
            'status_id' => 1,
            'comments' => 'Paquete recibido en bodega'
        ]);

        ShipmentHistory::create([
            'shipment_id' => 1,
            'location_id' => 2,
            'status_id' => 2,
            'comments' => 'En tránsito hacia Quetzaltenango'
        ]);
    }
}
