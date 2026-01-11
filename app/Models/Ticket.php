<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hiking_schedule_id',
        'total_people',
        'status',
        'price',
        'total_price',
        'verification_code',
        'verified_at',
        'returned_at',     // ⬅️ TANGGAL TURUN
        'hike_date',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'returned_at' => 'datetime', // ⬅️ PENTING (BIAR GA STRING)
        'hike_date'   => 'date',
    ];

    /* =====================
     | STATUS
     ===================== */
    public const STATUS_PENDING   = 'pending';
    public const STATUS_APPROVED  = 'approved';
    public const STATUS_REJECTED  = 'rejected';
    public const STATUS_USED      = 'used';       // sudah masuk gunung
    public const STATUS_COMPLETED = 'completed';  // sudah turun

    /* =====================
     | RELATION
     ===================== */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(HikingSchedule::class, 'hiking_schedule_id');
    }

    public function members()
    {
        return $this->hasMany(TicketMember::class);
    }

    /* =====================
     | BUSINESS LOGIC
     ===================== */

    /**
     * Bisa diverifikasi masuk gunung?
     */
    public function canBeVerified(): bool
    {
        return $this->status === self::STATUS_APPROVED
            && $this->hike_date->isToday()
            && is_null($this->verified_at);
    }

    /**
     * Sedang berada di gunung?
     */
    public function isInMountain(): bool
    {
        return $this->status === self::STATUS_USED
            && is_null($this->returned_at);
    }

    /**
     * Sudah turun dengan aman?
     */
    public function hasReturned(): bool
    {
        return $this->status === self::STATUS_COMPLETED
            && !is_null($this->returned_at);
    }
}
