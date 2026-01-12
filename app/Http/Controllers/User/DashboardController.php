<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Tiket aktif (prioritas)
        $activeTicket = Ticket::with(['schedule.mountain'])
            ->where('user_id', $user->id)
            ->whereIn('status', [
                Ticket::STATUS_PENDING,
                Ticket::STATUS_APPROVED,
                Ticket::STATUS_USED,
            ])
            ->orderByRaw("
                CASE status
                    WHEN 'used' THEN 1
                    WHEN 'approved' THEN 2
                    WHEN 'pending' THEN 3
                END
            ")
            ->first();

        // Statistik user
        $totalTickets = Ticket::where('user_id', $user->id)->count();

        $mountainCount = Ticket::where('user_id', $user->id)
            ->whereIn('status', [
                Ticket::STATUS_USED,
                Ticket::STATUS_COMPLETED
            ])
            ->distinct('hiking_schedule_id')
            ->count('hiking_schedule_id');

        $lastTicket = Ticket::where('user_id', $user->id)
            ->latest()
            ->first();

        $lastStatus = $lastTicket?->status ?? '-';

        // Riwayat tiket terbaru
        $latestTickets = Ticket::with(['schedule.mountain'])
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('users.dashboard', compact(
            'activeTicket',
            'totalTickets',
            'mountainCount',
            'lastStatus',
            'latestTickets'
        ));
    }
}
