<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Pages\CreateQualityProcedure;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Pages\EditQualityProcedure;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Pages\ListQualityProcedures;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\RelationManagers\ProcessesRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Schemas\QualityProcedureForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Tables\QualityProceduresTable;

class QualityProcedureResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'quality_procedure_name';

    public static function getModel(): string
    {
        return ModelResolver::qualityProcedure();
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
        return QualityProcedureForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return QualityProceduresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ProcessesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQualityProcedures::route('/'),
            'create' => CreateQualityProcedure::route('/create'),
            'edit' => EditQualityProcedure::route('/{record}/edit'),
        ];
    }
}
