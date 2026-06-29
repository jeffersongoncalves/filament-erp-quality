<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\QualityGoalResource;

class ListQualityGoals extends ListRecords
{
    protected static string $resource = QualityGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
