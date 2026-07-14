<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::latest();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $documents = $query->get();

        // Get unique types & categories for filter dropdowns
        $types = Document::select('type')->distinct()->pluck('type');
        $categories = Document::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('dokumentasi', compact('documents', 'types', 'categories'));
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('dokumentasi-show', compact('document'));
    }

    public function stream($id)
    {
        $document = Document::findOrFail($id);
        $path = $document->file;

        if (!$path || !Storage::disk('uploads')->exists($path)) {
            abort(404);
        }

        return response()->file(Storage::disk('uploads')->path($path), [
            'Content-Type' => Storage::disk('uploads')->mimeType($path),
            'Content-Disposition' => 'inline; filename="' . $document->title . '.' . pathinfo($path, PATHINFO_EXTENSION) . '"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
