<?php

namespace App\Filament\Resources\Sections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\View\View;
use App\Models\Section;

class SectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('issuance_from')
                    ->date('j F Y')
                    ->label('Issuance from'),
                TextColumn::make('issuance_to')
                    ->date('j F Y')
                    ->label('Issuance to'),
                TextColumn::make('volume_name')
                    ->label('Volume'),
                TextColumn::make('book_name')
                    ->label('No.'),
                TextColumn::make('hash')
                    ->label('Hash'),
                TextColumn::make('user.name')
                    ->label('Assigned to'),
                TextColumn::make('approval.status')
                    ->label('Status')
                    ->default('New')
                    ->badge()
                    ->color(function ($record) {
                        return match ($record->approval?->status) {
                            "completed" => Color::hex('#28a745'),
                            "submitted" => 'info',
                            "checked" => Color::hex('#ffc107'),
                            "rejected" => Color::hex('#dc3545'),
                            default => 'primary',
                            null => 'primary'
                        };
                    })
                    ->action(
                        Action::make('Activity')
                            ->slideOver()
                            ->modalContent(fn (Section $record): View => view(
                                'filament.pages.status',
                                ['record' => $record],
                            ))
                            ->modalSubmitAction(false)
                    ),
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
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
