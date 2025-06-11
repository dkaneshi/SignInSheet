<?php

use App\Models\Team;

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
