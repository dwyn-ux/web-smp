<?php

namespace App\Http\Controllers;

use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view('dokumentasi', compact('documents'));
    }
}
