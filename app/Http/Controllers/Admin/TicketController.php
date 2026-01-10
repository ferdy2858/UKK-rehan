<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HikingSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * List semua tiket
     */
    public function index()
    {
        $tickets = Ticket::with([
            'user',
            'schedule.mountain'
        ])
            ->latest()
            ->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Detail tiket
     */
    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'schedule.mountain',
            'members'
        ]);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * APPROVE TIKET
     */
    public function approve(Ticket $ticket)
    {
        if ($ticket->status !== Ticket::STATUS_PENDING) {
            return back()->with('error', 'Tiket sudah diproses.');
        }

        DB::transaction(function () use ($ticket) {

            $schedule = HikingSchedule::lockForUpdate()
                ->findOrFail($ticket->hiking_schedule_id);

            // hitung kuota real
            $approved = $schedule->tickets()
                ->where('status', Ticket::STATUS_APPROVED)
                ->sum('total_people');

            $remainingQuota = $schedule->quota - $approved;

            if ($remainingQuota < $ticket->total_people) {
                abort(422, 'Kuota tidak mencukupi.');
            }

            $ticket->update([
                'status' => Ticket::STATUS_APPROVED,
                'verification_code' => 'MTN-' . strtoupper(Str::random(8)),
            ]);
        });

        return back()->with('success', 'Tiket berhasil di-approve.');
    }

    /**
     * REJECT TIKET
     */
    public function reject(Ticket $ticket)
    {
        if ($ticket->status !== Ticket::STATUS_PENDING) {
            return back()->with('error', 'Tiket sudah diproses.');
        }

        $ticket->update([
            'status' => Ticket::STATUS_REJECTED
        ]);

        return back()->with('success', 'Tiket berhasil ditolak.');
    }
}
