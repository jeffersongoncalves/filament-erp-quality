<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Enums\NonConformanceStatus;

class NonConformancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof NonConformanceStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        NonConformanceStatus::Open => 'info',
                        NonConformanceStatus::InProgress => 'warning',
                        NonConformanceStatus::Resolved => 'success',
                        NonConformanceStatus::Closed => 'gray',
                        NonConformanceStatus::Cancelled => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('qualityProcedure.quality_procedure_name')
                    ->label('Procedure')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        $options = [];

        foreach (NonConformanceStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
