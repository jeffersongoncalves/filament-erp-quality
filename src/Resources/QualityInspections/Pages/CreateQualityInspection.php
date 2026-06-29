<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\QualityInspectionResource;

class CreateQualityInspection extends CreateRecord
{
    protected static string $resource = QualityInspectionResource::class;
}
