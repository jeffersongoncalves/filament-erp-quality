<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QualityGoalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('goal')
                    ->label('Goal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('procedure')
                    ->label('Procedure')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('frequency')
                    ->label('Frequency')
                    ->badge()
                    ->sortable(),
            ])
            ->defaultSort('goal')
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
