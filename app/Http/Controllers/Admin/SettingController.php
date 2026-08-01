<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings', [
            'latitude' => Setting::get('site_latitude', '-6.914744'),
            'longitude' => Setting::get('site_longitude', '107.609810'),
            'address' => Setting::get('site_address', 'SMP Muhammadiyah Unggulan Ashidiq'),
            'imageSettings' => $this->imageSettings(),
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'site_latitude' => 'required|numeric|between:-90,90',
            'site_longitude' => 'required|numeric|between:-180,180',
            'site_address' => 'required|string|max:255',
        ];

        $imageKeys = array_column($this->imageSettings(), 'key');
        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $rules[$key] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
            }
        }

        $request->validate($rules);

        Setting::set('site_latitude', $request->site_latitude);
        Setting::set('site_longitude', $request->site_longitude);
        Setting::set('site_address', $request->site_address);

        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('site', 'uploads');
                Setting::set($key, 'uploads/' . $path);
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    private function imageSettings(): array
    {
        return [
            ['key' => 'site_logo', 'label' => 'Logo Sekolah', 'default' => 'assets/logo smp.png'],
            ['key' => 'site_kegiatan_1', 'label' => 'Kegiatan 1 (Beranda)', 'default' => 'assets/kegiatan-1.jpg'],
            ['key' => 'site_kegiatan_2', 'label' => 'Kegiatan 2 (Beranda)', 'default' => 'assets/kegiatan-2.jpg'],
            ['key' => 'site_kegiatan_3', 'label' => 'Kegiatan 3 (Beranda)', 'default' => 'assets/kegiatan-3.jpg'],
            ['key' => 'site_kegiatan_4', 'label' => 'Kegiatan 4 (Beranda)', 'default' => 'assets/kegiatan-4.jpg'],
            ['key' => 'site_program_tahfidz', 'label' => 'Program Tahfidz', 'default' => 'assets/program-tahfidz.jpg'],
            ['key' => 'site_program_akademik', 'label' => 'Program Akademik', 'default' => 'assets/program-akademik.jpg'],
            ['key' => 'site_program_ekskul', 'label' => 'Program Ekskul', 'default' => 'assets/program-ekskul.jpg'],
            ['key' => 'site_profil_hero', 'label' => 'Gedung Sekolah (Profil)', 'default' => 'assets/sekolah.jpg'],
            ['key' => 'site_profil_tentang', 'label' => 'Foto Tentang (Profil)', 'default' => 'assets/tentang.jpg'],
        ];
    }
}
