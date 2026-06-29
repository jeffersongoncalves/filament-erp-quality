<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\QualityProcedureResource;

class EditQualityProcedure extends EditRecord
{
    protected static string $resource = QualityProcedureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
