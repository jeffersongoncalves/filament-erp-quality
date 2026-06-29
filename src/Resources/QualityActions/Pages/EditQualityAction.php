<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\QualityActionResource;

class EditQualityAction extends EditRecord
{
    protected static string $resource = QualityActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
