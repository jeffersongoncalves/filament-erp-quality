<?php

namespace JeffersonGoncalves\FilamentErp\Quality\Tests;

use Composer\InstalledVersions;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Erp\Core\ErpCoreServiceProvider;
use JeffersonGoncalves\Erp\Quality\ErpQualityServiceProvider;
use JeffersonGoncalves\FilamentErp\Core\Testing\InteractsWithErpFilament;
use JeffersonGoncalves\FilamentErp\Quality\FilamentErpQualityServiceProvider;
use JeffersonGoncalves\FilamentErp\Quality\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\FilamentErp\Quality\Tests\Fixtures\TestUser;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithErpFilament;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rebindFilamentDataStore();

        // The domain factories ship in the vendored packages; resolve them by
        // basename across the Quality and Core packages.
        Factory::guessFactoryNamesUsing($this->erpFactoryResolver([
            'JeffersonGoncalves\\Erp\\Quality\\Database\\Factories',
            'JeffersonGoncalves\\Erp\\Core\\Database\\Factories',
        ]));

        Filament::setCurrentPanel(Filament::getDefaultPanel());

        $this->withoutVite();

        $this->actingAs(TestUser::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
    }

    protected function getPackageProviders($app): array
    {
        return array_merge($this->filamentTestProviders(), [
            ErpCoreServiceProvider::class,
            ErpQualityServiceProvider::class,
            FilamentErpQualityServiceProvider::class,
            TestPanelProvider::class,
        ]);
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('auth.providers.users.model', TestUser::class);

        $coreConfig = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-core').'/config/erp-core.php';

        if (file_exists($coreConfig)) {
            $app['config']->set('erp-core', require $coreConfig);
        }

        $qualityConfig = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-quality').'/config/erp-quality.php';

        if (file_exists($qualityConfig)) {
            $app['config']->set('erp-quality', require $qualityConfig);
        }
    }

    protected function defineDatabaseMigrations(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default('');
            $table->rememberToken();
        });

        $this->loadErpVendorMigrations([
            'core' => [
                'create_erp_companies_table',
                'create_erp_currencies_table',
                'create_erp_currency_exchanges_table',
                'create_erp_uoms_table',
                'create_erp_uom_conversions_table',
                'create_erp_fiscal_years_table',
                'create_erp_departments_table',
                'create_erp_designations_table',
                'create_erp_brands_table',
                'create_erp_terms_and_conditions_table',
                'create_erp_addresses_table',
                'create_erp_contacts_table',
                'create_erp_naming_series_table',
            ],
            'quality' => [
                'create_erp_quality_goals_table',
                'create_erp_quality_goal_objectives_table',
                'create_erp_quality_procedures_table',
                'create_erp_quality_procedure_processes_table',
                'create_erp_quality_inspection_templates_table',
                'create_erp_quality_inspection_template_parameters_table',
                'create_erp_quality_inspections_table',
                'create_erp_quality_inspection_readings_table',
                'create_erp_non_conformances_table',
                'create_erp_quality_actions_table',
                'create_erp_quality_action_resolutions_table',
                'create_erp_quality_reviews_table',
                'create_erp_quality_review_objectives_table',
            ],
        ]);
    }
}
