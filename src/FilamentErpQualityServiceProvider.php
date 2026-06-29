<?php

namespace JeffersonGoncalves\FilamentErp\Quality;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpQualityServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-quality';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
