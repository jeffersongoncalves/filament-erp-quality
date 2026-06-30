<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QualityProcedureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
