<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\QualityGoalResource;

class EditQualityGoal extends EditRecord
{
    protected static string $resource = QualityGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
