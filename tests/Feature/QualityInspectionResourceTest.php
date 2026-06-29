<?php

use JeffersonGoncalves\Erp\Quality\Enums\InspectionResult;
use JeffersonGoncalves\Erp\Quality\Enums\InspectionType;
use JeffersonGoncalves\Erp\Quality\Enums\ReadingStatus;
use JeffersonGoncalves\Erp\Quality\Models\QualityInspection;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\CreateQualityInspection;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\EditQualityInspection;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\Pages\ListQualityInspections;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspections\RelationManagers\ReadingsRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the quality inspection list page', function () {
    Livewire::test(ListQualityInspections::class)->assertSuccessful();
});

it('can render the quality inspection create page', function () {
    Livewire::test(CreateQualityInspection::class)->assertSuccessful();
});

it('can render the quality inspection edit page', function () {
    $inspection = QualityInspection::factory()->create();

    Livewire::test(EditQualityInspection::class, ['record' => $inspection->getRouteKey()])
        ->assertSuccessful();
});

it('can create a quality inspection through the form', function () {
    Livewire::test(CreateQualityInspection::class)
        ->fillForm([
            'item_code' => 'ITEM-7777',
            'item_name' => 'Steel Bracket',
            'inspection_type' => InspectionType::Incoming->value,
            'sample_size' => 5,
            'status' => InspectionResult::Accepted->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(QualityInspection::query()->where('item_code', 'ITEM-7777')->exists())->toBeTrue();
});

it('recomputes the inspection status to rejected when a rejected reading is added', function () {
    $inspection = QualityInspection::factory()->create([
        'status' => InspectionResult::Accepted->value,
    ]);

    expect($inspection->status)->toBe(InspectionResult::Accepted);

    Livewire::test(ReadingsRelationManager::class, [
        'ownerRecord' => $inspection,
        'pageClass' => EditQualityInspection::class,
    ])
        ->callTableAction('create', data: [
            'specification' => 'Length tolerance',
            'reading_value' => '12.5',
            'status' => ReadingStatus::Rejected->value,
        ])
        ->assertHasNoTableActionErrors();

    expect($inspection->refresh()->status)->toBe(InspectionResult::Rejected);
});
