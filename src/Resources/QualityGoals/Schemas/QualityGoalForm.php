<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QualityGoalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('goal')
                            ->label('Goal')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('procedure')
                            ->label('Procedure')
                            ->maxLength(255),
                        TextInput::make('frequency')
                            ->label('Frequency')
                            ->default('None')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
