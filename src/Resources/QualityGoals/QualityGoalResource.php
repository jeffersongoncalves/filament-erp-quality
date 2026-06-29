<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals;

use Filament\Forms\Form;
use Filament\Resources\Resource;
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
    protected static ?string $navigationIcon = 'heroicon-o-flag';

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

    public static function form(Form $form): Form
    {
        return QualityGoalForm::configure($form);
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
