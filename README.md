<div class="filament-hidden">

![Filament ERP Quality](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-quality/3.x/art/jeffersongoncalves-filament-erp-quality.png)

</div>

# Filament ERP Quality

Filament v5 panel resources for the [Laravel ERP quality module](https://github.com/jeffersongoncalves/laravel-erp-quality) — inspections, goals, procedures and non-conformances.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-quality` domain package (namespace `JeffersonGoncalves\Erp\Quality\`). It wires the quality-management models into ready-to-use Filament resources and a quality dashboard widget.

## Features

- **Quality management** — Goals, procedures, reviews and actions, each with relation managers
- **Inspections** — Inspection templates and inspections with a readings relation manager
- **Non-conformances** — Track and resolve non-conformances
- **Dashboard widget** — `QualityStatsWidget` with inspection and non-conformance counts
- **Configurable** — Swap resource classes, change the navigation group or assign a cluster via config

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-quality
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityPlugin;

$panel->plugin(
    FilamentErpQualityPlugin::make()
        ->navigationGroup('ERP — Quality'),
);
```

## Resources

| Resource | Purpose |
|----------|---------|
| `QualityGoalResource` | Quality goals (+ Objectives relation manager) |
| `QualityProcedureResource` | Quality procedures (+ Processes relation manager) |
| `QualityInspectionTemplateResource` | Inspection templates (+ Parameters relation manager) |
| `QualityInspectionResource` | Quality inspections (+ Readings relation manager) |
| `NonConformanceResource` | Non-conformances |
| `QualityActionResource` | Quality actions (+ Resolutions relation manager) |
| `QualityReviewResource` | Quality reviews (+ Objectives relation manager) |

## Widgets

| Widget | Purpose |
|--------|---------|
| `QualityStatsWidget` | Inspection and non-conformance counts |

## Configuration

Publish the config to swap resource classes, change the navigation group, or adjust widgets:

```bash
php artisan vendor:publish --tag="filament-erp-quality-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
