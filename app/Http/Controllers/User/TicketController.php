<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMember;
use App\Models\HikingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * List tiket user
     */
    public function index()
    {
        $tickets = Ticket::with(['schedule.mountain'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('users.tickets.index', compact('tickets'));
    }

    /**
     * Form pesan tiket
     */
    public function create()
    {
        $schedules = HikingSchedule::with(['mountain', 'tickets'])
            ->whereDate('end_date', '>=', now())
            ->where('status', 'open')
            ->get()
            ->map(function ($schedule) {

                $approvedPeople = $schedule->tickets
                    ->where('status', Ticket::STATUS_APPROVED)
                    ->sum('total_people');

                $schedule->remaining_quota = max(
                    $schedule->quota - $approvedPeople,
                    0
                );

                return $schedule;
            })
            ->filter(fn($schedule) => $schedule->remaining_quota > 0);

        return view('users.tickets.create', compact('schedules'));
    }


    /**
     * SIMPAN TIKET
     */
    public function store(Request $request)
    {
        $request->validate([
            'hiking_schedule_id' => ['required', 'exists:hiking_schedules,id'],
            'hike_date'          => ['required', 'date', 'after_or_equal:today'],
            'total_people'       => ['required', 'integer', 'min:1'],
            'members'            => ['required', 'array'],
            'members.*.name'     => ['required', 'string'],
            'members.*.nik'      => ['required', 'string'],
            'members.*.phone'    => ['required', 'string'],
        ]);

        DB::transaction(function () use ($request) {

            $schedule = HikingSchedule::lockForUpdate()
                ->with('tickets')
                ->findOrFail($request->hiking_schedule_id);

            // hitung sisa kuota real
            $approved = $schedule->tickets()
                ->where('status', Ticket::STATUS_APPROVED)
                ->sum('total_people');

            $remainingQuota = $schedule->quota - $approved;

            if ($remainingQuota < $request->total_people) {
                abort(422, 'Kuota tidak mencukupi');
            }

            // simpan ticket
            $ticket = Ticket::create([
                'user_id'            => auth()->id(),
                'hiking_schedule_id' => $schedule->id,
                'hike_date'          => Carbon::parse($request->hike_date),
                'total_people'       => $request->total_people,
                'price'              => $schedule->price,
                'total_price'        => $schedule->price * $request->total_people,
                'status'             => Ticket::STATUS_PENDING,
                'verification_code'  => strtoupper(Str::random(8)),
            ]);

            // simpan anggota
            foreach ($request->members as $member) {
                TicketMember::create([
                    'ticket_id' => $ticket->id,
                    'name'      => $member['name'],
                    'nik'       => $member['nik'],
                    'phone'     => $member['phone'],
                ]);
            }
        });

        return redirect()
            ->route('user.tickets.index')
            ->with('success', 'Tiket berhasil dipesan, menunggu verifikasi admin.');
    }

    /**
     * Detail tiket
     */
    public function show(Ticket $ticket)
    {
        abort_if($ticket->user_id !== auth()->id(), 403);

        $ticket->load(['schedule.mountain', 'members']);

        return view('users.tickets.show', compact('ticket'));
    }
}
