<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class QualityProcedureForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('quality_procedure_name')
                            ->label('Procedure Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('parent_quality_procedure_id')
                            ->label('Parent Procedure')
                            ->relationship('parent', 'quality_procedure_name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Toggle::make('is_group')
                            ->label('Is Group')
                            ->default(false),
                        TextInput::make('process_owner')
                            ->label('Process Owner')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
