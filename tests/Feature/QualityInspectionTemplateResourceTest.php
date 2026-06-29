<?php

use JeffersonGoncalves\Erp\Quality\Models\QualityInspectionTemplate;
use JeffersonGoncalves\Erp\Quality\Models\QualityInspectionTemplateParameter;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\CreateQualityInspectionTemplate;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\EditQualityInspectionTemplate;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\Pages\ListQualityInspectionTemplates;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityInspectionTemplates\RelationManagers\ParametersRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the quality inspection template list page', function () {
    Livewire::test(ListQualityInspectionTemplates::class)->assertSuccessful();
});

it('can create a quality inspection template through the form', function () {
    Livewire::test(CreateQualityInspectionTemplate::class)
        ->fillForm([
            'name' => 'Visual Inspection',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(QualityInspectionTemplate::query()->where('name', 'Visual Inspection')->exists())->toBeTrue();
});

it('can add a parameter through the relation manager', function () {
    $template = QualityInspectionTemplate::factory()->create();

    Livewire::test(ParametersRelationManager::class, [
        'ownerRecord' => $template,
        'pageClass' => EditQualityInspectionTemplate::class,
    ])
        ->callTableAction('create', data: [
            'specification' => 'Length',
            'numeric' => true,
            'min_value' => 1,
            'max_value' => 10,
        ])
        ->assertHasNoTableActionErrors();

    expect(QualityInspectionTemplateParameter::query()
        ->where('quality_inspection_template_id', $template->id)
        ->where('specification', 'Length')
        ->exists())->toBeTrue();
});
