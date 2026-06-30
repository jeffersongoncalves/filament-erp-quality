<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\CreateQualityInspectionTemplate;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\EditQualityInspectionTemplate;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\ListQualityInspectionTemplates;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\RelationManagers\ParametersRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Schemas\QualityInspectionTemplateForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Tables\QualityInspectionTemplatesTable;

class QualityInspectionTemplateResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::qualityInspectionTemplate();
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
        return QualityInspectionTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QualityInspectionTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ParametersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQualityInspectionTemplates::route('/'),
            'create' => CreateQualityInspectionTemplate::route('/create'),
            'edit' => EditQualityInspectionTemplate::route('/{record}/edit'),
        ];
    }
}
