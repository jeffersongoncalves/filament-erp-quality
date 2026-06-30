<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionResult;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionType;

class QualityInspectionForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Item')
                    ->schema([
                        TextInput::make('item_code')
                            ->label('Item Code')
                            ->maxLength(255),
                        TextInput::make('item_name')
                            ->label('Item Name')
                            ->maxLength(255),
                        Select::make('inspection_type')
                            ->label('Inspection Type')
                            ->options(self::enumOptions(InspectionType::cases()))
                            ->default(InspectionType::Incoming->value)
                            ->required(),
                        TextInput::make('sample_size')
                            ->label('Sample Size')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])->columns(2),
                Section::make('Reference')
                    ->schema([
                        TextInput::make('reference_type')
                            ->label('Reference Type')
                            ->maxLength(255),
                        TextInput::make('reference_name')
                            ->label('Reference Name')
                            ->maxLength(255),
                        Select::make('quality_inspection_template_id')
                            ->label('Inspection Template')
                            ->relationship('qualityInspectionTemplate', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
                Section::make('Result')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(self::enumOptions(InspectionResult::cases()))
                            ->default(InspectionResult::Accepted->value)
                            ->required(),
                        TextInput::make('inspected_by')
                            ->label('Inspected By')
                            ->maxLength(255),
                        DatePicker::make('report_date')
                            ->label('Report Date'),
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
