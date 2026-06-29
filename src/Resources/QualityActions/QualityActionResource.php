<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages\CreateQualityAction;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages\EditQualityAction;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages\ListQualityActions;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\RelationManagers\ResolutionsRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Schemas\QualityActionForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Tables\QualityActionsTable;

class QualityActionResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?int $navigationSort = 12;

    protected static ?string $recordTitleAttribute = 'corrective_preventive';

    public static function getModel(): string
    {
        return ModelResolver::qualityAction();
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
        return QualityActionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QualityActionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ResolutionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQualityActions::route('/'),
            'create' => CreateQualityAction::route('/create'),
            'edit' => EditQualityAction::route('/{record}/edit'),
        ];
    }
}
