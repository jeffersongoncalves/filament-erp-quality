<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages\CreateQualityReview;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages\EditQualityReview;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages\ListQualityReviews;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\RelationManagers\ObjectivesRelationManager;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Schemas\QualityReviewForm;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Tables\QualityReviewsTable;

class QualityReviewResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'goal';

    public static function getModel(): string
    {
        return ModelResolver::qualityReview();
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
        return QualityReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QualityReviewsTable::configure($table);
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
            'index' => ListQualityReviews::route('/'),
            'create' => CreateQualityReview::route('/create'),
            'edit' => EditQualityReview::route('/{record}/edit'),
        ];
    }
}
