<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Erp\Quality\Enums\QualityActionStatus;

class QualityActionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('corrective_preventive')
                            ->label('Corrective / Preventive')
                            ->default('Corrective')
                            ->required()
                            ->maxLength(255),
                        Select::make('status')
                            ->label('Status')
                            ->options(self::enumOptions(QualityActionStatus::cases()))
                            ->default(QualityActionStatus::Open->value)
                            ->required(),
                        TextInput::make('review')
                            ->label('Review')
                            ->maxLength(255),
                        DatePicker::make('date')
                            ->label('Date'),
                        TextInput::make('goal')
                            ->label('Goal')
                            ->maxLength(255),
                        TextInput::make('procedure')
                            ->label('Procedure')
                            ->maxLength(255),
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
