<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $navigationLabel = 'Envíos';

    protected static ?string $modelLabel = 'Envío';

    protected static ?string $pluralModelLabel = 'Envíos';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('tracking_number')
                    ->label('Número de Seguimiento')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_id')
                    ->label('Estado')
                    ->relationship('status', 'name')
                    ->required(),
                Forms\Components\Select::make('current_location_id')
                    ->label('Ubicación Actual')
                    ->relationship('location', 'name')
                    ->required(),
                Forms\Components\TextInput::make('employee_name')
                    ->label('Nombre del Empleado')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_number')
                    ->label('Número de Seguimiento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->label('Estado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Ubicación Actual')
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee_name')
                    ->label('Empleado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([
                //
            ])
            ->searchable(['tracking_number', 'employee_name'])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
