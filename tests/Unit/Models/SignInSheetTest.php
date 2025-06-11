<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Models\SignInEntry;
use App\Models\SignInSheet;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function () {
    $signInSheet = SignInSheet::factory()->create()->fresh();

    expect(array_keys($signInSheet->toArray()))
        ->toEqual([
            'id',
            'organization_id',
            'team_id',
            'start_date',
            'end_date',
            'created_at',
            'updated_at',
        ]);
});

it('has a factory that creates a valid sign in sheet', function () {
    $signInSheet = SignInSheet::factory()->create();

    expect($signInSheet)
        ->toBeInstanceOf(SignInSheet::class)
        ->organization_id->toBeInt()
        ->team_id->toBeInt()
        ->start_date->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->end_date->toBeInstanceOf(Carbon\CarbonImmutable::class);
});

it('belongs to an organization', function () {
    $signInSheet = SignInSheet::factory()->create();

    expect($signInSheet->organization())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($signInSheet->organization)
        ->toBeInstanceOf(Organization::class);
});

it('belongs to a team', function () {
    $signInSheet = SignInSheet::factory()->create();

    expect($signInSheet->team())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($signInSheet->team)
        ->toBeInstanceOf(Team::class);
});

it('has sign in entries', function () {
    $signInSheet = SignInSheet::factory()->create();

    expect($signInSheet->signInEntries())
        ->toBeInstanceOf(HasMany::class)
        ->and($signInSheet->signInEntries)
        ->toBeInstanceOf(Collection::class);
});

it('has many sign in entries', function () {
    $signInSheet = SignInSheet::factory()
        ->has(SignInEntry::factory()->count(3))
        ->create();

    expect($signInSheet->signInEntries)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(SignInEntry::class);
});
