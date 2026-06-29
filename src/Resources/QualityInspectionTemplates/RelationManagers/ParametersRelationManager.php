<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParametersRelationManager extends RelationManager
{
    protected static string $relationship = 'parameters';

    protected static ?string $title = 'Parameters';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('specification')
                    ->label('Specification')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('value')
                    ->label('Value')
                    ->maxLength(255),
                Toggle::make('numeric')
                    ->label('Numeric')
                    ->default(false),
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
                TextColumn::make('value')
                    ->label('Value'),
                IconColumn::make('numeric')
                    ->label('Numeric')
                    ->boolean(),
                TextColumn::make('min_value')
                    ->label('Min Value')
                    ->numeric(),
                TextColumn::make('max_value')
                    ->label('Max Value')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
