<?php

namespace Database\Factories;

use App\Models\SignInSheet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SignInEntry>
 */
class SignInEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'sign_in_sheet_id' => SignInSheet::factory(),
            'start_time' => now(),
            'lunch_start' => now()->addMinutes(240),
            'lunch_end' => now()->addMinutes(285),
            'end_time' => now()->addMinutes(480),
        ];
    }
}
