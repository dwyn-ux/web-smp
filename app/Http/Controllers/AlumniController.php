<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'current_school' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'suggestion' => 'required|string|max:1000',
            'photo' => 'required|image|max:5120'
        ]);

        $photoPath = $request->file('photo')->store('alumni', 'public');

        Alumni::create([
            'name' => $request->name,
            'class_level' => $request->class_level,
            'address' => $request->address,
            'current_school' => $request->current_school,
            'message' => $request->message,
            'suggestion' => $request->suggestion,
            'photo' => '/storage/' . $photoPath,
            'status' => 'pending'
        ]);

        return redirect()->route('alumni.create')->with('success', 'Terima kasih. Data alumni Anda sudah terkirim.');
    }
}
