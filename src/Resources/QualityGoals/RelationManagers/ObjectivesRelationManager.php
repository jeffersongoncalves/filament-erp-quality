<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ObjectivesRelationManager extends RelationManager
{
    protected static string $relationship = 'objectives';

    protected static ?string $title = 'Objectives';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
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
}
