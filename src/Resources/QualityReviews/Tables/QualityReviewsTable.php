<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QualityReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('qualityGoal.goal')
                    ->label('Goal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        'Open' => 'info',
                        'In Progress' => 'warning',
                        'Completed' => 'success',
                        'Cancelled' => 'gray',
                        default => 'gray',
                    }),
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
        return [
            'Open' => 'Open',
            'In Progress' => 'In Progress',
            'Completed' => 'Completed',
            'Cancelled' => 'Cancelled',
        ];
    }
}
