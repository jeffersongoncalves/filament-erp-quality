<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\QualityActionResource;

class ListQualityActions extends ListRecords
{
    protected static string $resource = QualityActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
