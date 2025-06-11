<?php

use App\Models\Organization;

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
