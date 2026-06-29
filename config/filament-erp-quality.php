<?php

use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\NonConformanceResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityActions\QualityActionResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\QualityGoalResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\QualityInspectionResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\QualityInspectionTemplateResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityProcedures\QualityProcedureResource;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityReviews\QualityReviewResource;
use JeffersonGoncalves\FilamentErp\Quality\Widgets\QualityStatsWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP Quality resources are listed in
    | the Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Quality',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'quality_goal' => QualityGoalResource::class,
        'quality_procedure' => QualityProcedureResource::class,
        'quality_inspection_template' => QualityInspectionTemplateResource::class,
        'quality_inspection' => QualityInspectionResource::class,
        'non_conformance' => NonConformanceResource::class,
        'quality_action' => QualityActionResource::class,
        'quality_review' => QualityReviewResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'quality_stats' => QualityStatsWidget::class,
    ],

];
