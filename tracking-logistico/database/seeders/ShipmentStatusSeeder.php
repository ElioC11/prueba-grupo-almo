<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ShipmentStatus;

class ShipmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ShipmentStatus::create(['name' => 'Recibido']);
        ShipmentStatus::create(['name' => 'En tránsito']);
        ShipmentStatus::create(['name' => 'En reparto']);
        ShipmentStatus::create(['name' => 'Entregado']);
    }
}
