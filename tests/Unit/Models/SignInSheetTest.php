<?php

use App\Models\SignInSheet;

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
