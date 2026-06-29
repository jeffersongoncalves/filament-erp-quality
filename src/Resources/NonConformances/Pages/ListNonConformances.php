<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\NonConformanceResource;

class ListNonConformances extends ListRecords
{
    protected static string $resource = NonConformanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
