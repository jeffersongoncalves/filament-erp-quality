<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Enums\QualityActionStatus;

class ResolutionsRelationManager extends RelationManager
{
    protected static string $relationship = 'resolutions';

    protected static ?string $title = 'Resolutions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('problem')
                    ->label('Problem')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('resolution')
                    ->label('Resolution')
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options(self::statusOptions())
                    ->default(QualityActionStatus::Open->value)
                    ->required(),
                TextInput::make('responsible')
                    ->label('Responsible')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('problem')
            ->columns([
                TextColumn::make('problem')
                    ->label('Problem'),
                TextColumn::make('resolution')
                    ->label('Resolution'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => (string) $state)
                    ->color(fn ($state): string => match ((string) $state) {
                        'Open' => 'info',
                        'In Progress' => 'warning',
                        'Completed' => 'success',
                        'Cancelled' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('responsible')
                    ->label('Responsible'),
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
        $options = [];

        foreach (QualityActionStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
