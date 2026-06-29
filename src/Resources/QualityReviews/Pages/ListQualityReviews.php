<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\QualityReviewResource;

class ListQualityReviews extends ListRecords
{
    protected static string $resource = QualityReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
