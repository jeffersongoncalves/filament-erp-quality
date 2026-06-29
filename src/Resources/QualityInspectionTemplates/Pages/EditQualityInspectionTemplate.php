<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\QualityInspectionTemplateResource;

class EditQualityInspectionTemplate extends EditRecord
{
    protected static string $resource = QualityInspectionTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
