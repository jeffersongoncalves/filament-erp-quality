<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\QualityActionResource;

class CreateQualityAction extends CreateRecord
{
    protected static string $resource = QualityActionResource::class;
}
