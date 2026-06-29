<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\NonConformanceResource;

class EditNonConformance extends EditRecord
{
    protected static string $resource = NonConformanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
