<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\QualityReviewResource;

class CreateQualityReview extends CreateRecord
{
    protected static string $resource = QualityReviewResource::class;
}
