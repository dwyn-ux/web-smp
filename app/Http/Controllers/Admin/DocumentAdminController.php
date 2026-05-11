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
            'type' => 'required'
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');
        $size = round($file->getSize() / 1024 / 1024, 2) . ' MB';

        Document::create([
            'title' => $request->title,
            'file' => '/storage/' . $path,
            'type' => $request->type,
            'size' => $size
        ]);

        return redirect()->route('admin.documents.index');
    }

    public function destroy($id)
    {
        Document::findOrFail($id)->delete();
        return back();
    }
}
