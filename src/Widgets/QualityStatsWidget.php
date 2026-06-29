<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionResult;
use JeffersonGoncalves\Erp\Quality\Enums\NonConformanceStatus;
use JeffersonGoncalves\Erp\Quality\Support\ModelResolver;

/**
 * A snapshot of the quality desk: how many non-conformances are still open (not
 * resolved, closed or cancelled) and how many inspections came back rejected.
 */
class QualityStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $nonConformanceModel = ModelResolver::nonConformance();
        $inspectionModel = ModelResolver::qualityInspection();

        $openNonConformances = $nonConformanceModel::query()
            ->whereNotIn('status', [
                NonConformanceStatus::Resolved->value,
                NonConformanceStatus::Closed->value,
                NonConformanceStatus::Cancelled->value,
            ])
            ->count();

        $rejectedInspections = $inspectionModel::query()
            ->where('status', InspectionResult::Rejected->value)
            ->count();

        return [
            Stat::make('Open Non-Conformances', (string) $openNonConformances)
                ->description('awaiting resolution')
                ->color($openNonConformances > 0 ? 'warning' : 'gray'),
            Stat::make('Rejected Inspections', (string) $rejectedInspections)
                ->description('failed quality checks')
                ->color($rejectedInspections > 0 ? 'danger' : 'gray'),
        ];
    }
}
