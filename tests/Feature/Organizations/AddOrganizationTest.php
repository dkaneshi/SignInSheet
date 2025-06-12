<?php

declare(strict_types=1);

use App\Livewire\AddOrganization;
use App\Models\Organization;
use App\Models\User;
use Livewire\Livewire;

it('can render add organization component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.add-organization');
});

it('requires organization name', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', '')
        ->call('addOrganization')
        ->assertHasErrors(['name' => 'required']);
});

it('requires organization name to be at least 3 characters', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', 'ab')
        ->call('addOrganization')
        ->assertHasErrors(['name' => 'min']);
});

it('requires organization name to be at most 255 characters', function () {
    $user = User::factory()->create();
    $longName = str_repeat('a', 256);

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', $longName)
        ->call('addOrganization')
        ->assertHasErrors(['name' => 'max']);
});

it('requires organization name to be unique', function () {
    $user = User::factory()->create();
    $existingOrg = Organization::factory()->create(['name' => 'Existing Org']);

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', 'Existing Org')
        ->call('addOrganization')
        ->assertHasErrors(['name' => 'unique']);
});

it('creates a new organization', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', 'New Test Organization')
        ->call('addOrganization')
        ->assertHasNoErrors();

    expect(Organization::query()->where('name', 'New Test Organization')->exists())->toBeTrue();
});

it('resets form after successful submission', function () {
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', 'Test Organization')
        ->call('addOrganization');

    expect($component->get('name'))->toBe('');
});

it('dispatches organization-added event after successful submission', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(AddOrganization::class)
        ->set('name', 'Event Test Organization')
        ->call('addOrganization')
        ->assertDispatched('organization-added');
});
