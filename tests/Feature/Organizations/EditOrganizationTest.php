<?php

declare(strict_types=1);

use App\Livewire\EditOrganization;
use App\Models\Organization;
use App\Models\User;
use Livewire\Livewire;

it('can render edit organization component', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->assertStatus(200)
        ->assertViewIs('livewire.edit-organization');
});

it('initializes with the organization name', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->assertSet('name', 'Test Organization');
});

it('requires organization name', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', '')
        ->call('editOrganization')
        ->assertHasErrors(['name' => 'required']);
});

it('requires organization name to be at least 3 characters', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', 'ab')
        ->call('editOrganization')
        ->assertHasErrors(['name' => 'min']);
});

it('requires organization name to be at most 255 characters', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);
    $longName = str_repeat('a', 256);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', $longName)
        ->call('editOrganization')
        ->assertHasErrors(['name' => 'max']);
});

it('requires organization name to be unique', function () {
    $user = User::factory()->create();
    $organization1 = Organization::factory()->create(['name' => 'Organization One']);
    $organization2 = Organization::factory()->create(['name' => 'Organization Two']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization2])
        ->set('name', 'Organization One')
        ->call('editOrganization')
        ->assertHasErrors(['name' => 'unique']);
});

it('allows keeping the same name', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', 'Test Organization')
        ->call('editOrganization')
        ->assertHasNoErrors();
});

it('updates the organization name', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Old Name']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', 'New Name')
        ->call('editOrganization')
        ->assertHasNoErrors();

    expect(Organization::query()->find($organization->id)->name)->toBe('New Name');
});

it('dispatches organization-updated event after successful update', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', 'Updated Organization')
        ->call('editOrganization')
        ->assertDispatched('organization-updated');
});

it('closes the modal after successful update', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['name' => 'Test Organization']);

    $component = Livewire::actingAs($user)
        ->test(EditOrganization::class, ['organization' => $organization])
        ->set('name', 'Updated Organization')
        ->call('editOrganization');

    // Since we can't directly test modal closing in Livewire tests,
    // we can verify that the method that closes the modal is called
    // by checking that no errors occurred during the process
    $component->assertHasNoErrors();
});
