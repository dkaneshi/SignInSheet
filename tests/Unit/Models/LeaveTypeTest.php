<?php

use App\Models\LeaveType;

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
