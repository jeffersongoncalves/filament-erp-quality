<?php

namespace JeffersonGoncalves\FilamentErp\Quality;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Quality\Concerns\HasErpQualityPluginConfig;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\NonConformanceResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\QualityActionResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\QualityGoalResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\QualityInspectionResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\QualityInspectionTemplateResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\QualityProcedureResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\QualityReviewResource;

class FilamentErpQualityPlugin implements Plugin
{
    use HasErpQualityPluginConfig;

    public function getId(): string
    {
        return 'filament-erp-quality';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
            'quality_goal' => QualityGoalResource::class,
            'quality_procedure' => QualityProcedureResource::class,
            'quality_inspection_template' => QualityInspectionTemplateResource::class,
            'quality_inspection' => QualityInspectionResource::class,
            'non_conformance' => NonConformanceResource::class,
            'quality_action' => QualityActionResource::class,
            'quality_review' => QualityReviewResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
