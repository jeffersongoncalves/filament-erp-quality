<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QualityReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        Select::make('quality_goal_id')
                            ->label('Quality Goal')
                            ->relationship('qualityGoal', 'goal')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DatePicker::make('date')
                            ->label('Date'),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::statusOptions())
                            ->default('Open')
                            ->required(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
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
