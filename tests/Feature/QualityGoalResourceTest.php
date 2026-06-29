<?php

use JeffersonGoncalves\Erp\Quality\Models\QualityGoal;
use JeffersonGoncalves\Erp\Quality\Models\QualityGoalObjective;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\CreateQualityGoal;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\EditQualityGoal;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\Pages\ListQualityGoals;
use JeffersonGoncalves\FilamentErp\Quality\Resources\QualityGoals\RelationManagers\ObjectivesRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the quality goal list page', function () {
    Livewire::test(ListQualityGoals::class)->assertSuccessful();
});

it('can render the quality goal create page', function () {
    Livewire::test(CreateQualityGoal::class)->assertSuccessful();
});

it('can render the quality goal edit page', function () {
    $goal = QualityGoal::factory()->create();

    Livewire::test(EditQualityGoal::class, ['record' => $goal->getRouteKey()])
        ->assertSuccessful();
});

it('can create a quality goal through the form', function () {
    Livewire::test(CreateQualityGoal::class)
        ->fillForm([
            'goal' => 'Reduce defect rate',
            'frequency' => 'Monthly',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(QualityGoal::query()->where('goal', 'Reduce defect rate')->exists())->toBeTrue();
});

it('can create an objective through the relation manager', function () {
    $goal = QualityGoal::factory()->create();

    Livewire::test(ObjectivesRelationManager::class, [
        'ownerRecord' => $goal,
        'pageClass' => EditQualityGoal::class,
    ])
        ->callTableAction('create', data: [
            'objective' => 'Defects below 2%',
            'target' => '2%',
            'uom' => 'Percent',
        ])
        ->assertHasNoTableActionErrors();

    expect(QualityGoalObjective::query()
        ->where('quality_goal_id', $goal->id)
        ->where('objective', 'Defects below 2%')
        ->exists())->toBeTrue();
});
