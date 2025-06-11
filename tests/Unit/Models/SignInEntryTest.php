<?php

use App\Models\SignInEntry;

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
