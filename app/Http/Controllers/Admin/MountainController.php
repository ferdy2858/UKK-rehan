<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'name'          => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'height'        => 'required|integer',
            'quota_per_day' => 'required|integer|min:1',
            'image' => 'nullable|file|mimetypes:image/jpeg,image/png,image/webp|max:2048',
        ]);

        $mountain = Mountain::create([
            'name'          => $validated['name'],
            'location'      => $validated['location'],
            'height'        => $validated['height'],
            'quota_per_day' => $validated['quota_per_day'],
        ]);

        if ($request->hasFile('image')) {
            $mountain->update([
                'image' => $request->file('image')
                    ->store('mountains', 'public'),
            ]);
        }
        
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
            'name'           => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'height'         => 'required|integer',
            'quota_per_day'  => 'required|integer|min:1',
            'image'          => 'nullable|image|max:2048',
        ]);

        // kalau upload image baru
        if ($request->hasFile('image')) {
            // hapus image lama
            if ($mountain->image) {
                Storage::disk('public')->delete($mountain->image);
            }

            $validated['image'] = $request->file('image')
                ->store('mountains', 'public');
        }

        $mountain->update($validated);

        return redirect()
            ->route('admin.mountains.index')
            ->with('success', 'Gunung berhasil diupdate');
    }

    public function destroy(Mountain $mountain)
    {
        // hapus image dari storage
        if ($mountain->image) {
            Storage::disk('public')->delete($mountain->image);
        }

        $mountain->delete();

        return redirect()
            ->route('admin.mountains.index')
            ->with('success', 'Gunung berhasil dihapus');
    }
}
