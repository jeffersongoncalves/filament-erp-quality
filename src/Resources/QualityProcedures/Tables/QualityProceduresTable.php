<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QualityProceduresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quality_procedure_name')
                    ->label('Procedure Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.quality_procedure_name')
                    ->label('Parent')
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('is_group')
                    ->label('Group')
                    ->boolean(),
                TextColumn::make('process_owner')
                    ->label('Owner')
                    ->toggleable()
                    ->searchable(),
            ])
            ->defaultSort('quality_procedure_name')
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
