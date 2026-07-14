<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AlumniGraduationYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlumniAdminController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->integer('graduation_year') ?: null;
        $graduationYears = AlumniGraduationYear::orderByDesc('year')->get();

        $alumni = Alumni::query()
            ->when($selectedYear, fn ($query) => $query->where('graduation_year', $selectedYear))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.alumni.index', compact('alumni', 'graduationYears', 'selectedYear'));
    }

    public function show($id)
    {
        $alumnus = Alumni::findOrFail($id);
        return view('admin.alumni.show', compact('alumnus'));
    }

    public function edit($id)
    {
        $alumnus = Alumni::findOrFail($id);
        $graduationYears = AlumniGraduationYear::orderByDesc('year')->get();

        return view('admin.alumni.edit', compact('alumnus', 'graduationYears'));
    }

    public function update(Request $request, $id)
    {
        $alumnus = Alumni::findOrFail($id);
        $allowedGraduationYears = AlumniGraduationYear::pluck('year')
            ->push($alumnus->graduation_year)
            ->filter()
            ->map(fn ($year) => (int) $year)
            ->unique()
            ->values()
            ->all();

        $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'current_school' => 'required|string|max:255',
            'current_university' => 'nullable|string|max:255',
            'graduation_year' => [
                'required',
                'integer',
                Rule::in($allowedGraduationYears),
            ],
            'message' => 'required|string|max:1000',
            'suggestion' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:5120',
            'status' => 'required|in:pending,approved,rejected',
            'show_on_homepage' => 'nullable|boolean'
        ]);

        $data = [
            'name' => $request->name,
            'class_level' => $request->class_level,
            'address' => $request->address,
            'current_school' => $request->current_school,
            'current_university' => $request->current_university,
            'graduation_year' => $request->graduation_year,
            'message' => $request->message,
            'suggestion' => $request->suggestion,
            'status' => $request->status,
            'show_on_homepage' => $request->has('show_on_homepage') ? (bool) $request->show_on_homepage : false,
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('alumni', 'uploads');
            $data['photo'] = str_replace('\\', '/', $photoPath);
        }

        $alumnus->update($data);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function storeGraduationYear(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100|unique:alumni_graduation_years,year',
        ]);

        AlumniGraduationYear::create($validated);

        return back()->with('success', 'Tahun kelulusan berhasil ditambahkan.');
    }

    public function destroyGraduationYear(AlumniGraduationYear $graduationYear)
    {
        $graduationYear->delete();

        return back()->with('success', 'Tahun kelulusan berhasil dihapus dari dropdown.');
    }

    public function approve($id)
    {
        $alumnus = Alumni::findOrFail($id);
        $alumnus->update(['status' => 'approved', 'show_on_homepage' => true]);

        return back()->with('success', 'Alumni berhasil disetujui dan ditampilkan.');
    }

    public function toggleVisibility($id)
    {
        $alumnus = Alumni::findOrFail($id);
        $alumnus->update(['show_on_homepage' => ! $alumnus->show_on_homepage]);

        return back()->with('success', 'Status tampilan alumni berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $selectedYear = $request->integer('graduation_year') ?: null;

        $alumni = Alumni::query()
            ->when($selectedYear, fn ($query) => $query->where('graduation_year', $selectedYear))
            ->orderBy('name')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data-alumni-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($alumni) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM for Excel UTF-8

            fputcsv($handle, [
                'Nama', 'Kelas SMP', 'Tahun Kelulusan', 'Alamat', 'Sekolah Sekarang', 'Universitas Sekarang',
                'Pesan & Kesan', 'Saran', 'Status', 'Tampil di Homepage', 'Tanggal Daftar'
            ]);

            foreach ($alumni as $a) {
                fputcsv($handle, [
                    $a->name,
                    $a->class_level,
                    $a->graduation_year,
                    $a->address,
                    $a->current_school,
                    $a->current_university,
                    $a->message,
                    $a->suggestion,
                    $a->status,
                    $a->show_on_homepage ? 'Ya' : 'Tidak',
                    $a->created_at->format('d/m/Y'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        Alumni::findOrFail($id)->delete();
        return back();
    }
}
