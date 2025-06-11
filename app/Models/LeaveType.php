<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\LeaveTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $abbreviation
 * @property-read SignInEntry $signInEntries
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
class LeaveType extends Model
{
    /** @use HasFactory<LeaveTypeFactory> */
    use HasFactory;

    public function signInEntries(): HasMany
    {
        return $this->hasMany(SignInEntry::class);
    }
}
