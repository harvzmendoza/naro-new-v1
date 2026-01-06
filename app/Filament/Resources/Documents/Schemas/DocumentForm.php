<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('issuance_no')
                    ->columnSpanFull(),
                Textarea::make('title')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('onar_no')
                    ->required(),
                TextInput::make('signatory'),
                TextInput::make('doc_date'),
                TextInput::make('doc_year'),
                TextInput::make('publish')
                    ->required()
                    ->numeric(),
                Textarea::make('content')
                    ->columnSpanFull(),
                Textarea::make('committee')
                    ->columnSpanFull(),
                Textarea::make('councilor')
                    ->columnSpanFull(),
                Textarea::make('author')
                    ->columnSpanFull(),
                TextInput::make('division_id')
                    ->numeric(),
                Textarea::make('members_of_division')
                    ->columnSpanFull(),
                Textarea::make('ponente')
                    ->columnSpanFull(),
                Textarea::make('subject')
                    ->columnSpanFull(),
                Textarea::make('parties')
                    ->columnSpanFull(),
                Textarea::make('case_status')
                    ->columnSpanFull(),
                TextInput::make('issuance_type_id')
                    ->numeric(),
                TextInput::make('agency_id')
                    ->required()
                    ->numeric(),
                TextInput::make('section_id')
                    ->required()
                    ->numeric(),
                TextInput::make('file')
                    ->required(),
                TextInput::make('date_filed'),
                TextInput::make('tags'),
            ]);
    }
}
