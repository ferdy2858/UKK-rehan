<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'name',
        'nik',
        'phone',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
