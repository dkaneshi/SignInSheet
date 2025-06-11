<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read Team $teams
 * @property-read SignInSheet $signInSheets
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function signInSheets(): HasMany
    {
        return $this->hasMany(SignInSheet::class);
    }
}
