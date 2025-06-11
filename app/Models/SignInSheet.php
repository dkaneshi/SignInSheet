<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read int $organization_id
 * @property-read Organization $organization
 * @property-read int $team_id
 * @property-read Team $team
 * @property-read SignInEntry $signInEntries
 * @property-read CarbonImmutable $start_date
 * @property-read CarbonImmutable $end_date
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
class SignInSheet extends Model
{
    /** @use HasFactory<\Database\Factories\SignInSheetFactory> */
    use HasFactory;

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function signInEntries(): HasMany
    {
        return $this->hasMany(SignInEntry::class);
    }
}
