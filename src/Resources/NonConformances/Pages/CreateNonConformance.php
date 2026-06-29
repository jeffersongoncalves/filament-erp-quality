<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\NonConformanceResource;

class CreateNonConformance extends CreateRecord
{
    protected static string $resource = NonConformanceResource::class;
}
