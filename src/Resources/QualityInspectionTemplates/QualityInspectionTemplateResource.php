<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates;

use Filament\Forms\Form;
use Filament\Resources\Resource;
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
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

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

    public static function form(Form $form): Form
    {
        return QualityInspectionTemplateForm::configure($form);
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
