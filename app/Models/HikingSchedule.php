<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HikingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id',
        'date',
        'quota',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
