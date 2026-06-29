<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

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

    public static function form(Schema $schema): Schema
    {
        return QualityProcedureForm::configure($schema);
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
