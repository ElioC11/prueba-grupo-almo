<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="searchShipment" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-9">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="trackingNumber">Número de Seguimiento (Guía de Envío)</label>
                    <input
                        id="trackingNumber"
                        type="text"
                        wire:model.defer="trackingNumber"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Ingresa el número de seguimiento"
                        required
                    />
                    @error('trackingNumber')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-3 flex items-end">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Buscar
                    </button>
                </div>
            </div>
        </form>

        @if($shipment)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Historial del Envío: {{ $shipment->tracking_number }}</h2>

                @if($shipment->histories->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">No hay historial registrado para este envío.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Fecha</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Estado</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Ubicación</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                @foreach($shipment->histories->sortByDesc('created_at') as $history)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $history->status?->name ?? '-' }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $history->location?->name ?? '-' }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $history->comments ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-filament-panels::page>