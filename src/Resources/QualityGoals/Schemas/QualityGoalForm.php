<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class QualityGoalForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
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
