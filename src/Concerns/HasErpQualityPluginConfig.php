<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Concerns;

use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpPluginConfig;

trait HasErpQualityPluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-quality';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Quality';
    }
}
