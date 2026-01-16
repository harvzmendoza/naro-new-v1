<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use App\Models\Document;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\ViewAction;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section.volume_name')
                    ->description(fn (Document $record): string => "No. " . $record->section->book_name, position: 'below')
                    ->label('Volume'),
                TextColumn::make('agency.name')
                    ->wrap()
                    ->label('Agency'),
                TextColumn::make('date_filed')
                    ->date()
                    ->sortable(),
                TextColumn::make('onar_no')
                    ->label('ONAR No.')
                    ->searchable(),
                TextColumn::make('issuance_no')
                    ->label('Issuance Number')
                    ->url(fn (Document $record) => url("/storage/$record->file"))
                    ->description(fn (Document $record): string => $record->title, position: 'below')
                    ->wrap()
                    ->searchable(['issuance_no', 'title']),
                TextColumn::make('doc_date')
                    ->label('Date Adopted')
                    ->date()
                    ->sortable(),
                IconColumn::make('publish')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('doc_date')
                    ->form([
                        DatePicker::make('date_from'),
                        DatePicker::make('date_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('doc_date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('doc_date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make()->modalWidth('7xl'),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
    
}
