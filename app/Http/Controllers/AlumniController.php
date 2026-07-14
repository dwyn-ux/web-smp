<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AlumniGraduationYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::approved()->latest()->paginate(12);

        return view('alumni.index', compact('alumni'));
    }

    public function create()
    {
        $graduationYears = AlumniGraduationYear::orderByDesc('year')->get();

        return view('alumni.create', compact('graduationYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'current_school' => 'required|string|max:255',
            'current_university' => 'nullable|string|max:255',
            'graduation_year' => [
                'required',
                'integer',
                Rule::exists('alumni_graduation_years', 'year'),
            ],
            'message' => 'required|string|max:1000',
            'suggestion' => 'required|string|max:1000',
            'photo' => 'required|image|max:5120'
        ]);

        $photoPath = $request->file('photo')->store('alumni', 'uploads');
        $photoPath = str_replace('\\', '/', $photoPath);

        Alumni::create([
            'name' => $request->name,
            'class_level' => $request->class_level,
            'address' => $request->address,
            'current_school' => $request->current_school,
            'current_university' => $request->current_university,
            'graduation_year' => $request->graduation_year,
            'message' => $request->message,
            'suggestion' => $request->suggestion,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return redirect()->route('alumni.create')->with('success', 'Terima kasih. Data alumni Anda sudah terkirim.');
    }
}
