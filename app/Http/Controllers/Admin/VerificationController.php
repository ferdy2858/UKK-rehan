<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        return view('admin.verification.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string',
        ]);

        $ticket = Ticket::with(['user', 'schedule.mountain', 'members'])
            ->where('verification_code', $request->verification_code)
            ->first();

        if (!$ticket) {
            return back()->with('error', '❌ Kode verifikasi tidak ditemukan');
        }

        // hanya tiket approved
        if ($ticket->status !== Ticket::STATUS_APPROVED) {
            return back()->with('error', '❌ Tiket belum valid / sudah digunakan');
        }

        // hanya boleh diverifikasi di hari H
        if ($ticket->hike_date !== now()->toDateString()) {
            return back()->with(
                'error',
                '❌ Verifikasi hanya bisa dilakukan di hari pendakian'
            );
        }

        // sudah pernah dipakai
        if ($ticket->verified_at) {
            return back()->with('error', '❌ Tiket sudah digunakan');
        }

        // 🔥 VERIFIKASI BERHASIL
        $ticket->update([
            'status'      => 'used',
            'verified_at' => now(),
        ]);

        return back()->with('success', '✅ Tiket valid, pendaki boleh masuk');
    }
}
