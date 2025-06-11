<?php

declare(strict_types=1);

use App\Models\LeaveType;
use App\Models\SignInEntry;
use App\Models\SignInSheet;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('to array', function () {
    $signInEntry = SignInEntry::factory()->create()->fresh();

    expect(array_keys($signInEntry->toArray()))
        ->toEqual([
            'id',
            'user_id',
            'sign_in_sheet_id',
            'leave_type_id',
            'start_time',
            'lunch_start',
            'lunch_end',
            'end_time',
            'overtime_hours',
            'notes',
            'created_at',
            'updated_at',
        ]);
});

it('has a factory that creates a valid sign in entry', function () {
    $leaveType = LeaveType::factory()->create();
    $signInEntry = SignInEntry::factory()->create([
        'leave_type_id' => $leaveType->id,
        'overtime_hours' => 2,
        'notes' => 'Test notes',
    ]);

    expect($signInEntry)
        ->toBeInstanceOf(SignInEntry::class)
        ->user_id->toBeInt()
        ->sign_in_sheet_id->toBeInt()
        ->leave_type_id->toBeInt()
        ->start_time->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->lunch_start->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->lunch_end->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->end_time->toBeInstanceOf(Carbon\CarbonImmutable::class)
        ->overtime_hours->toBeInt()
        ->notes->toBeString();
});

it('belongs to a user', function () {
    $signInEntry = SignInEntry::factory()->create();

    expect($signInEntry->user())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($signInEntry->user)
        ->toBeInstanceOf(User::class);
});

it('belongs to a sign in sheet', function () {
    $signInEntry = SignInEntry::factory()->create();

    expect($signInEntry->signInSheet())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($signInEntry->signInSheet)
        ->toBeInstanceOf(SignInSheet::class);
});

it('belongs to a leave type', function () {
    $leaveType = LeaveType::factory()->create();
    $signInEntry = SignInEntry::factory()->create(['leave_type_id' => $leaveType->id]);

    expect($signInEntry->leaveType())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($signInEntry->leaveType)
        ->toBeInstanceOf(LeaveType::class);
});
