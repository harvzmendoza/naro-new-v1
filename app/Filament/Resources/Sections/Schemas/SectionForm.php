<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('volume_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('book_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('issuance_from')
                    ->required()
                    ->maxLength(255),
                TextInput::make('issuance_to')
                    ->required()
                    ->maxLength(255),
                TextInput::make('hash')
                    ->maxLength(255),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
