<?php

it('loads the filament-erp-quality config file', function () {
    expect(config('filament-erp-quality'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-quality.navigation_group'))->toBe('ERP — Quality');
});

it('registers all resources in config', function () {
    $resources = config('filament-erp-quality.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'quality_goal',
            'quality_procedure',
            'quality_inspection_template',
            'quality_inspection',
            'non_conformance',
            'quality_action',
            'quality_review',
        ]);
});

it('registers the dashboard widgets in config', function () {
    expect(config('filament-erp-quality.widgets'))->toBeArray()
        ->toHaveKeys(['quality_stats']);
});
