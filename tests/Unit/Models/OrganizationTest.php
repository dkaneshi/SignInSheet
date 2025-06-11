<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Models\SignInSheet;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function () {
    $organization = Organization::factory()->create()->fresh();

    expect(array_keys($organization->toArray()))
        ->toEqual([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
});

it('has a factory that creates a valid organization', function () {
    $organization = Organization::factory()->create();

    expect($organization)
        ->toBeInstanceOf(Organization::class)
        ->name->toBeString();
});

it('has teams', function () {
    $organization = Organization::factory()->create();

    expect($organization->teams())
        ->toBeInstanceOf(HasMany::class)
        ->and($organization->teams)
        ->toBeInstanceOf(Collection::class);
});

it('has many teams', function () {
    $organization = Organization::factory()
        ->has(Team::factory()->count(3))
        ->create();

    expect($organization->teams)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Team::class);
});

it('has sign in sheets', function () {
    $organization = Organization::factory()->create();

    expect($organization->signInSheets())
        ->toBeInstanceOf(HasMany::class)
        ->and($organization->signInSheets)
        ->toBeInstanceOf(Collection::class);
});

it('has many sign in sheets', function () {
    $organization = Organization::factory()
        ->has(SignInSheet::factory()->count(3))
        ->create();

    expect($organization->signInSheets)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(SignInSheet::class);
});
