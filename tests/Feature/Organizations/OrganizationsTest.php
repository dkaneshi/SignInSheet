<?php

declare(strict_types=1);

use App\Livewire\ListOrganizations;
use App\Livewire\Organizations;
use App\Models\User;
use Livewire\Livewire;

it('can render organizations screen', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/organizations');

    $response->assertStatus(200);
});

it('can render organizations component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Organizations::class)
        ->assertStatus(200);
});

it('contains list-organizations component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Organizations::class)
        ->assertSeeLivewire(ListOrganizations::class);
});
