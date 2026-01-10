<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'hike_date'
    ];
    
    protected $casts = [
        'verified_at' => 'datetime',
        'hike_date'   => 'date',
    ];


    public const STATUS_PENDING  = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_USED = 'used';

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
    public function canBeVerified(): bool
    {
        return $this->status === self::STATUS_APPROVED
            && $this->hike_date === now()->toDateString()
            && is_null($this->verified_at);
    }
}
