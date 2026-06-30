<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class QualityInspectionTemplateForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }
}
