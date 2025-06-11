<?php

use App\Models\LeaveType;
use App\Models\SignInEntry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function () {
    $leaveType = LeaveType::factory()->create()->fresh();

    expect(array_keys($leaveType->toArray()))
        ->toEqual([
            'id',
            'name',
            'abbreviation',
            'created_at',
            'updated_at',
        ]);
});

it('has a factory that creates a valid leave type', function () {
    $leaveType = LeaveType::factory()->create();

    expect($leaveType)
        ->toBeInstanceOf(LeaveType::class)
        ->name->toBeString()
        ->abbreviation->toBeString();
});

it('has sign in entries', function () {
    $leaveType = LeaveType::factory()->create();

    expect($leaveType->signInEntries())
        ->toBeInstanceOf(HasMany::class)
        ->and($leaveType->signInEntries)
        ->toBeInstanceOf(Collection::class);
});

it('has many sign in entries', function () {
    $leaveType = LeaveType::factory()
        ->has(SignInEntry::factory()->count(3))
        ->create();

    expect($leaveType->signInEntries)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(SignInEntry::class);
});
