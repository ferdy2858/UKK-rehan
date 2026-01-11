<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {

        $stats = [
            'total_tickets' => Ticket::count(),

            'pending' => Ticket::where('status', Ticket::STATUS_PENDING)->count(),

            'approved' => Ticket::where('status', Ticket::STATUS_APPROVED)->count(),

            'in_mountain' => Ticket::where('status', Ticket::STATUS_USED)
                ->whereNull('returned_at')
                ->count(),

            'completed' => Ticket::where('status', Ticket::STATUS_COMPLETED)->count(),

            // ✅ PENDAPATAN BULAN INI
            'monthly_income' => Ticket::where(function ($q) {
                $q->where(function ($q2) {
                    $q2->where('status', Ticket::STATUS_USED)
                        ->whereMonth('verified_at', now()->month)
                        ->whereYear('verified_at', now()->year);
                })
                    ->orWhere(function ($q2) {
                        $q2->where('status', Ticket::STATUS_COMPLETED)
                            ->whereMonth('returned_at', now()->month)
                            ->whereYear('returned_at', now()->year);
                    });
            })
                ->sum('total_price'),
        ];


        /* =========================
           PENDAKI AKTIF DI GUNUNG
        ========================= */
        $activeHikers = Ticket::with(['user', 'schedule.mountain'])
            ->where('status', Ticket::STATUS_USED)
            ->whereNull('returned_at')
            ->get()
            ->map(function ($ticket) {

                // 🔥 FIX TOTAL (DATE vs DATE)
                $start = $ticket->hike_date;   // Carbon DATE
                $today = now()->startOfDay();  // JAM DI-NOL-IN

                $ticket->day_number = $start->diffInDays($today) + 1;

                return $ticket;
            });


        /* =========================
           PENDAKI OVERDUE
           (naik > end_date)
        ========================= */
        $overdueHikers = $activeHikers->filter(function ($ticket) {
            return now()->gt($ticket->schedule->end_date);
        });

        /* =========================
           TIKET TERBARU
        ========================= */
        $latestTickets = Ticket::with(['user', 'schedule.mountain'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'activeHikers',
            'overdueHikers',
            'latestTickets'
        ));
    }
}
