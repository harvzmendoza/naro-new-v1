<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('document_id')
                    ->label('Document')
                    ->relationship('document', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('remarks')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
