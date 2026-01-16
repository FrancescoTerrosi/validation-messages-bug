<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Partner;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->validationMessages([
                        'required' => 'Inserire il nome del partner.',
                    ])
                    ->label('Nome'),
                TextInput::make('enrolfee')
                    ->numeric()
                    ->minValue(1)
                    ->validationMessages([
                        'min:1' => 'Inserire un valore valido (maggiore di 1)',
                    ])
                    ->label('Quota iscrizione partner'),
                TextInput::make('percentagefee')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->validationMessages([
                        'min' => 'Inserire un  valore compreso fra 0 e 100',
                        'max' => 'Inserire un  valore compreso fra 0 e 100',
                    ])
                    ->label('Percentuale ricavo da partner figli'),
                Select::make('partner_parent_id')
                    ->options(fn ($record) => $record ? Partner::where('id', '!=', $record->id)->pluck('name', 'id') : Partner::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->loadingMessage('Caricamento partner...')
                    ->label('Partner padre'),
            ]);
    }
}
