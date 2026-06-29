<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\CreateQualityGoal;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\EditQualityGoal;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\ListQualityGoals;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\RelationManagers\ObjectivesRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Schemas\QualityGoalForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Tables\QualityGoalsTable;

class QualityGoalResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'goal';

    public static function getModel(): string
    {
        return ModelResolver::qualityGoal();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpQualityPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-quality.navigation_group', 'ERP — Quality');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return QualityGoalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QualityGoalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ObjectivesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQualityGoals::route('/'),
            'create' => CreateQualityGoal::route('/create'),
            'edit' => EditQualityGoal::route('/{record}/edit'),
        ];
    }
}
