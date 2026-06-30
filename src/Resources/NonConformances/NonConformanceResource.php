<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\CreateNonConformance;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\EditNonConformance;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\ListNonConformances;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Schemas\NonConformanceForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Tables\NonConformancesTable;

class NonConformanceResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'subject';

    public static function getModel(): string
    {
        return ModelResolver::nonConformance();
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
        return NonConformanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NonConformancesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNonConformances::route('/'),
            'create' => CreateNonConformance::route('/create'),
            'edit' => EditNonConformance::route('/{record}/edit'),
        ];
    }
}
