<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('to array', function () {
    $team = Team::factory()->create()->fresh();

    expect(array_keys($team->toArray()))
        ->toEqual([
            'id',
            'name',
            'organization_id',
            'created_at',
            'updated_at',
        ]);
});

it('has a factory that creates a valid team', function () {
    $team = Team::factory()->create();

    expect($team)
        ->toBeInstanceOf(Team::class)
        ->name->toBeString()
        ->organization_id->toBeInt();
});

it('belongs to an organization', function () {
    $team = Team::factory()->create();

    expect($team->organization())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($team->organization)
        ->toBeInstanceOf(Organization::class);
});

it('has many users', function () {
    $team = Team::factory()
        ->has(User::factory()->count(3))
        ->create();

    $teamUsers = User::query()->where('team_id', $team->id)->get();

    expect($teamUsers)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(User::class);
});
