<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|max:5120',
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'uploads');

            Gallery::create([
                'title' => $request->title,
                'image' => $path,
            ]);
        }

        $count = count($request->file('images'));
        return redirect()->route('admin.gallery.index')->with('success', "$count foto berhasil diupload!");
    }

    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return back();
    }
}
