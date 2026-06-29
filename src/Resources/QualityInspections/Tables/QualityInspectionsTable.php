<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionResult;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionType;

class QualityInspectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item_name')
                    ->label('Item Name')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('inspection_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof InspectionType ? $state->value : (string) $state)
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof InspectionResult ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        InspectionResult::Accepted => 'success',
                        InspectionResult::Rejected => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('qualityInspectionTemplate.name')
                    ->label('Template')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('inspected_by')
                    ->label('Inspected By')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('report_date')
                    ->label('Report Date')
                    ->date()
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
                SelectFilter::make('inspection_type')
                    ->label('Type')
                    ->options(self::typeOptions()),
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

        foreach (InspectionResult::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }

    /** @return array<string, string> */
    protected static function typeOptions(): array
    {
        $options = [];

        foreach (InspectionType::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
