<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\QualityProcedureResource;

class ListQualityProcedures extends ListRecords
{
    protected static string $resource = QualityProcedureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
