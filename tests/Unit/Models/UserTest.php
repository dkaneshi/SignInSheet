<?php

use App\Models\User;

test('to array', function () {
    $user = User::factory()->create()->fresh();

    expect(array_keys($user->toArray()))
        ->toEqual([
                'id',
                'name',
                'email',
                'email_verified_at',
                'team_id',
                'created_at',
                'updated_at',
            ]);
});
