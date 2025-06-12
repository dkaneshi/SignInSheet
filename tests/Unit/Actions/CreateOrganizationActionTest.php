<?php

declare(strict_types=1);

use App\Actions\Organization\CreateOrganizationAction;
use App\Models\Organization;

it('creates an organization with valid data', function () {
    // Arrange
    $action = new CreateOrganizationAction();
    $data = ['name' => 'Test Organization'];

    // Act
    $organization = $action->handle($data);

    // Assert
    expect($organization)->toBeInstanceOf(Organization::class);
    expect($organization->name)->toBe('Test Organization');
    expect($organization->exists)->toBeTrue();

    // Verify it's in the database
    $this->assertDatabaseHas('organizations', [
        'id' => $organization->id,
        'name' => 'Test Organization',
    ]);
});

it('returns the created organization instance', function () {
    // Arrange
    $action = new CreateOrganizationAction();
    $data = ['name' => 'Another Organization'];

    // Act
    $organization = $action->handle($data);

    // Assert
    expect($organization)->toBeInstanceOf(Organization::class);
    expect($organization->id)->toBeInt();
    expect($organization->name)->toBe('Another Organization');
});

it('creates an organization with only required fields', function () {
    // Arrange
    $action = new CreateOrganizationAction();
    $data = ['name' => 'Minimal Organization'];

    // Act
    $organization = $action->handle($data);

    // Assert
    expect($organization)->toBeInstanceOf(Organization::class);
    expect($organization->name)->toBe('Minimal Organization');
    expect($organization->exists)->toBeTrue();
});
