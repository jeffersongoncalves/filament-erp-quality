<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\CreateQualityInspection;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\EditQualityInspection;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\ListQualityInspections;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\RelationManagers\ReadingsRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Schemas\QualityInspectionForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Tables\QualityInspectionsTable;

class QualityInspectionResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'item_code';

    public static function getModel(): string
    {
        return ModelResolver::qualityInspection();
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
        return QualityInspectionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return QualityInspectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ReadingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQualityInspections::route('/'),
            'create' => CreateQualityInspection::route('/create'),
            'edit' => EditQualityInspection::route('/{record}/edit'),
        ];
    }
}
