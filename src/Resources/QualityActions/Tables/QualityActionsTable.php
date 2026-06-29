<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Enums\QualityActionStatus;

class QualityActionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('corrective_preventive')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof QualityActionStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        QualityActionStatus::Open => 'info',
                        QualityActionStatus::InProgress => 'warning',
                        QualityActionStatus::Completed => 'success',
                        QualityActionStatus::Cancelled => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('goal')
                    ->label('Goal')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
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

        foreach (QualityActionStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
