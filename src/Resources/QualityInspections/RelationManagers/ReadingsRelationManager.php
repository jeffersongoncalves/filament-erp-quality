<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Enums\ReadingStatus;

class ReadingsRelationManager extends RelationManager
{
    protected static string $relationship = 'readings';

    protected static ?string $title = 'Readings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                TextInput::make('specification')
                    ->label('Specification')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('value')
                    ->label('Value')
                    ->maxLength(255),
                TextInput::make('reading_value')
                    ->label('Reading Value')
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options(self::statusOptions())
                    ->default(ReadingStatus::Accepted->value)
                    ->required(),
                TextInput::make('min_value')
                    ->label('Min Value')
                    ->numeric(),
                TextInput::make('max_value')
                    ->label('Max Value')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('specification')
            ->columns([
                TextColumn::make('specification')
                    ->label('Specification'),
                TextColumn::make('reading_value')
                    ->label('Reading Value'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof ReadingStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        ReadingStatus::Accepted => 'success',
                        ReadingStatus::Rejected => 'danger',
                        default => 'gray',
                    }),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
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

        foreach (ReadingStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
