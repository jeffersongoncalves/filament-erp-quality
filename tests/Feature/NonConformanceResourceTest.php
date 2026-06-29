<?php

use JeffersonGoncalves\Erp\Quality\Enums\NonConformanceStatus;
use JeffersonGoncalves\Erp\Quality\Models\NonConformance;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\CreateNonConformance;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\EditNonConformance;
use JeffersonGoncalves\FilamentErp\Quality\Resources\NonConformances\Pages\ListNonConformances;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the non-conformance list page', function () {
    Livewire::test(ListNonConformances::class)->assertSuccessful();
});

it('can render the non-conformance create page', function () {
    Livewire::test(CreateNonConformance::class)->assertSuccessful();
});

it('can render the non-conformance edit page', function () {
    $nonConformance = NonConformance::factory()->create();

    Livewire::test(EditNonConformance::class, ['record' => $nonConformance->getRouteKey()])
        ->assertSuccessful();
});

it('can create a non-conformance through the form', function () {
    Livewire::test(CreateNonConformance::class)
        ->fillForm([
            'subject' => 'Surface scratch detected',
            'status' => NonConformanceStatus::Open->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(NonConformance::query()->where('subject', 'Surface scratch detected')->exists())->toBeTrue();
});

it('can filter non-conformances by status', function () {
    NonConformance::factory()->create(['status' => NonConformanceStatus::Open]);
    NonConformance::factory()->create(['status' => NonConformanceStatus::Closed]);

    Livewire::test(ListNonConformances::class)
        ->filterTable('status', NonConformanceStatus::Open->value)
        ->assertSuccessful();
});
