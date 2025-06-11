<?php

declare(strict_types=1);

use App\Livewire\ListOrganizations;
use App\Models\Organization;
use App\Models\User;
use Livewire\Livewire;

it('can render list organizations component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ListOrganizations::class)
        ->assertStatus(200);
});

it('displays organizations', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(ListOrganizations::class)
        ->assertSee('Test Organization');
});

it('paginates organizations', function () {
    $user = User::factory()->create();

    // Create 11 organizations (more than the 10 per page)
    Organization::factory()->count(11)->create();

    // Get the first organization (should be on first page)
    $firstOrg = Organization::query()->orderBy('name')->first();

    // Get the last organization (should be on second page)
    $lastOrg = Organization::query()->orderBy('name', 'desc')->first();

    Livewire::actingAs($user)
        ->test(ListOrganizations::class)
        ->assertSee($firstOrg->name)
        ->assertDontSee($lastOrg->name);
});

it('refreshes when organization-added event is fired', function () {
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(ListOrganizations::class);

    // Create a new organization
    $newOrg = Organization::factory()->create(['name' => 'New Test Organization']);

    // Dispatch the organization-added event
    $component->dispatch('organization-added');

    // Assert that the new organization is visible
    $component->assertSee('New Test Organization');
});
