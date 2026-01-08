<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;

class MountainController extends Controller
{
    public function index()
    {
        $mountains = Mountain::latest()->get();
        return view('admin.mountains.index', compact('mountains'));
    }

    public function create()
    {
        return view('admin.mountains.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'height' => 'required|integer',
            'quota_per_day' => 'required|integer|min:1',
        ]);

        Mountain::create($validated);

        return redirect()
            ->route('admin.mountains.index')
            ->with('success', 'Gunung berhasil ditambahkan');
    }

    public function edit(Mountain $mountain)
    {
        return view('admin.mountains.edit', compact('mountain'));
    }

    public function update(Request $request, Mountain $mountain)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'height' => 'required|integer',
            'quota_per_day' => 'required|integer|min:1',
        ]);

        $mountain->update($validated);

        return redirect()
            ->route('admin.mountains.index')
            ->with('success', 'Gunung berhasil diupdate');
    }

    public function destroy(Mountain $mountain)
    {
        $mountain->delete();

        return redirect()
            ->route('admin.mountains.index')
            ->with('success', 'Gunung berhasil dihapus');
    }
}
