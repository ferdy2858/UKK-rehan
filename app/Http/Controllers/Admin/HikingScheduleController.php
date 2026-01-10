<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HikingSchedule;
use App\Models\Mountain;
use Illuminate\Http\Request;

class HikingScheduleController extends Controller
{
    public function index()
    {
        $schedules = HikingSchedule::with('mountain')
            ->orderBy('start_date')
            ->get();

        return view('admin.hiking-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $mountains = Mountain::orderBy('name')->get();

        return view('admin.hiking-schedules.create', compact('mountains'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mountain_id' => 'required|exists:mountains,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'quota'       => 'required|integer|min:1',
            'price'       => 'required|integer|min:1',
            'status'      => 'required|in:open,closed',
        ]);

        HikingSchedule::create($data);

        return redirect()
            ->route('admin.hiking-schedules.index')
            ->with('success', 'Jadwal pendakian berhasil ditambahkan');
    }

    public function edit(HikingSchedule $hikingSchedule)
    {
        $mountains = Mountain::orderBy('name')->get();

        return view(
            'admin.hiking-schedules.edit',
            compact('hikingSchedule', 'mountains')
        );
    }

    public function update(Request $request, HikingSchedule $hikingSchedule)
    {
        $data = $request->validate([
            'mountain_id' => 'required|exists:mountains,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'quota'       => 'required|integer|min:1',
            'price'       => 'required|integer|min:1',
            'status'      => 'required|in:open,closed',
        ]);

        $hikingSchedule->update($data);

        return redirect()
            ->route('admin.hiking-schedules.index')
            ->with('success', 'Jadwal pendakian berhasil diupdate');
    }

    public function destroy(HikingSchedule $hikingSchedule)
    {
        $hikingSchedule->delete();

        return redirect()
            ->route('admin.hiking-schedules.index')
            ->with('success', 'Jadwal pendakian berhasil dihapus');
    }
}
