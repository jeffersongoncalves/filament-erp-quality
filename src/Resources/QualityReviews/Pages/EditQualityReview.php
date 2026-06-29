<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\QualityReviewResource;

class EditQualityReview extends EditRecord
{
    protected static string $resource = QualityReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
