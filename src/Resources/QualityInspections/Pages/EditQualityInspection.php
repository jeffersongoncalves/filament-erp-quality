<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\QualityInspectionResource;

class EditQualityInspection extends EditRecord
{
    protected static string $resource = QualityInspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
