<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniAdminController extends Controller
{
    public function index()
    {
        $alumni = Alumni::latest()->paginate(10);
        return view('admin.alumni.index', compact('alumni'));
    }

    public function show($id)
    {
        $alumnus = Alumni::findOrFail($id);
        return view('admin.alumni.show', compact('alumnus'));
    }

    public function edit($id)
    {
        $alumnus = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumnus'));
    }

    public function update(Request $request, $id)
    {
        $alumnus = Alumni::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'current_school' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'suggestion' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:5120',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $data = [
            'name' => $request->name,
            'class_level' => $request->class_level,
            'address' => $request->address,
            'current_school' => $request->current_school,
            'message' => $request->message,
            'suggestion' => $request->suggestion,
            'status' => $request->status,
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('alumni', 'public');
            $data['photo'] = '/storage/' . $photoPath;
        }

        $alumnus->update($data);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Alumni::findOrFail($id)->delete();
        return back();
    }
}
