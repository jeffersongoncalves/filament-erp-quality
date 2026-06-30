<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ObjectivesRelationManager extends RelationManager
{
    protected static string $relationship = 'objectives';

    protected static ?string $title = 'Objectives';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('objective')
                    ->label('Objective')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('target')
                    ->label('Target')
                    ->maxLength(255),
                TextInput::make('uom')
                    ->label('UOM')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('objective')
            ->columns([
                TextColumn::make('objective')
                    ->label('Objective'),
                TextColumn::make('target')
                    ->label('Target'),
                TextColumn::make('uom')
                    ->label('UOM'),
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
