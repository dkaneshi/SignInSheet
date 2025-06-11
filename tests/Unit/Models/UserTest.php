<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

it('has a factory that creates a valid user', function () {
    $user = User::factory()->create();

    expect($user)
        ->toBeInstanceOf(User::class)
        ->name->toBeString()
        ->email->toBeString()
        ->password->toBeString();
});

it('belongs to a team', function () {
    $user = User::factory()->create();

    expect($user->team())
        ->toBeInstanceOf(BelongsTo::class)
        ->and($user->team)
        ->toBeInstanceOf(Team::class);
});

test('initials method returns first letters of name', function () {
    $user = User::factory()->create(['name' => 'John Doe']);
    expect($user->initials())->toBe('JD');

    $user = User::factory()->create(['name' => 'Jane Smith Johnson']);
    expect($user->initials())->toBe('JS');

    $user = User::factory()->create(['name' => 'Alice']);
    expect($user->initials())->toBe('A');
});

test('email verified at is cast to datetime', function () {
    $user = User::factory()->create();

    expect($user->email_verified_at)
        ->toBeInstanceOf(\Carbon\CarbonImmutable::class);
});

it('has a hashed password', function () {
    $password = 'password123';
    $user = User::factory()->create(['password' => $password]);

    expect($user->password)
        ->not->toBe($password)
        ->toBeString();
});

it('has fillable attributes', function () {
    $user = new User;

    expect($user->getFillable())
        ->toBe(['name', 'email', 'password']);
});

it('has hidden attributes', function () {
    $user = new User;

    expect($user->getHidden())
        ->toBe(['password', 'remember_token']);
});
