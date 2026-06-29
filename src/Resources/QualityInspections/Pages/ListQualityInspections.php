<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\QualityInspectionResource;

class ListQualityInspections extends ListRecords
{
    protected static string $resource = QualityInspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
