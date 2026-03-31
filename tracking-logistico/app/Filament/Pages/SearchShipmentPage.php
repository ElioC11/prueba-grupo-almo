<?php

namespace App\Filament\Pages;

use App\Models\Shipment;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class SearchShipmentPage extends Page
{
    protected string $view = 'filament.pages.search-shipment-page';

    public ?string $trackingNumber = null;
    public ?Shipment $shipment = null;

    public function mount(): void
    {
        $this->shipment = null;
    }

    public function searchShipment(): void
    {
        $this->validate([
            'trackingNumber' => 'required|string',
        ]);

        $this->shipment = Shipment::with(['histories.status', 'histories.location'])
            ->where('tracking_number', $this->trackingNumber)
            ->first();

        if (! $this->shipment) {
            $this->shipment = null;

            Notification::make()
                ->title('Envío no encontrado')
                ->body('No se encontró un envío con ese número de seguimiento.')
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title('Envío encontrado')
            ->body('Historial cargado correctamente.')
            ->success()
            ->send();
    }
}
