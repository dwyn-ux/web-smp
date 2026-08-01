<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityAdminController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('sort_order')->latest()->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        Facility::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->file('image')->store('facilities', 'uploads'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.form', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = $facility->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('facilities', 'uploads');
        }

        $facility->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}
