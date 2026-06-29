<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
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
                TextInput::make('achieved')
                    ->label('Achieved')
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options(self::statusOptions())
                    ->default('Open')
                    ->required(),
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
                TextColumn::make('achieved')
                    ->label('Achieved'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        'Open' => 'info',
                        'In Progress' => 'warning',
                        'Completed' => 'success',
                        'Cancelled' => 'gray',
                        default => 'gray',
                    }),
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

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        return [
            'Open' => 'Open',
            'In Progress' => 'In Progress',
            'Completed' => 'Completed',
            'Cancelled' => 'Cancelled',
        ];
    }
}
