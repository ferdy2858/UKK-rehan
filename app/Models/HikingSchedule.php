<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HikingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id',
        'start_date',
        'end_date',
        'quota',
        'status',
        'price',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /* =========================
       HELPER (OPSIONAL TAPI BERGUNA)
    ========================== */

    public function usedQuota()
    {
        return $this->tickets()
            ->where('status', Ticket::STATUS_APPROVED)
            ->sum('total_people');
    }

    public function getRemainingQuotaAttribute()
    {
        return $this->quota - $this->usedQuota();
    }

    public function isOpenFor(int $people): bool
    {
        return $this->status === 'open'
            && $this->remaining_quota >= $people;
    }
}
