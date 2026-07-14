<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentAdminController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|file',
            'type' => 'required',
            'category' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'uploads');
        $size = round($file->getSize() / 1024 / 1024, 2) . ' MB';

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('documents/thumbnails', 'uploads');
        }

        Document::create([
            'title' => $request->title,
            'file' => $path,
            'type' => $request->type,
            'category' => $request->category,
            'size' => $size,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.documents.index');
    }

    public function destroy($id)
    {
        Document::findOrFail($id)->delete();
        return back();
    }
}
