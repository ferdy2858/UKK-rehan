<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'height',
        'quota_per_day',
        'image',
    ];

    public function schedules()
    {
        return $this->hasMany(HikingSchedule::class);
    }
}
