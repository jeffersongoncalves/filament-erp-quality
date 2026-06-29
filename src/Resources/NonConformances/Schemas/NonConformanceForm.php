<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Quality\Enums\NonConformanceStatus;

class NonConformanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->maxLength(255),
                        Select::make('quality_procedure_id')
                            ->label('Quality Procedure')
                            ->relationship('qualityProcedure', 'quality_procedure_name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::enumOptions(NonConformanceStatus::cases()))
                            ->default(NonConformanceStatus::Open->value)
                            ->required(),
                        Textarea::make('details')
                            ->label('Details')
                            ->columnSpanFull(),
                        Textarea::make('corrective_action')
                            ->label('Corrective Action')
                            ->columnSpanFull(),
                        Textarea::make('preventive_action')
                            ->label('Preventive Action')
                            ->columnSpanFull(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    /**
     * @param  array<int, \BackedEnum>  $cases
     * @return array<string, string>
     */
    protected static function enumOptions(array $cases): array
    {
        $options = [];

        foreach ($cases as $case) {
            /** @var string $value */
            $value = $case->value;
            $options[$value] = $value;
        }

        return $options;
    }
}
