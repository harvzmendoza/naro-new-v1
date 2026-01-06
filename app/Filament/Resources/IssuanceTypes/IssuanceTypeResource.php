<?php

namespace App\Filament\Resources\IssuanceTypes;

use App\Filament\Resources\IssuanceTypes\Pages\CreateIssuanceType;
use App\Filament\Resources\IssuanceTypes\Pages\EditIssuanceType;
use App\Filament\Resources\IssuanceTypes\Pages\ListIssuanceTypes;
use App\Filament\Resources\IssuanceTypes\Schemas\IssuanceTypeForm;
use App\Filament\Resources\IssuanceTypes\Tables\IssuanceTypesTable;
use App\Models\IssuanceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IssuanceTypeResource extends Resource
{
    protected static ?string $model = IssuanceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return IssuanceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IssuanceTypesTable::configure($table);
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
            'index' => ListIssuanceTypes::route('/'),
            'create' => CreateIssuanceType::route('/create'),
            'edit' => EditIssuanceType::route('/{record}/edit'),
        ];
    }
}
