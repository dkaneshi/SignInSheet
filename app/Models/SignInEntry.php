<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read User $user
 * @property-read int $sign_in_sheet_id
 * @property-read SignInSheet $signInSheet
 * @property-read int $leave_type_id
 * @property-read LeaveType $leaveType
 * @property-read CarbonImmutable $start_time
 * @property-read CarbonImmutable $lunch_start
 * @property-read CarbonImmutable $lunch_end
 * @property-read CarbonImmutable $end_time
 * @property-read int $overtime_hours
 * @property-read string $notes
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
final class SignInEntry extends Model
{
    /** @use HasFactory<\Database\Factories\SignInEntryFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<SignInSheet, $this>
     */
    public function signInSheet(): BelongsTo
    {
        return $this->belongsTo(SignInSheet::class);
    }

    /**
     * @return BelongsTo<LeaveType, $this>
     */
    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }
}
