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
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_latitude' => 'required|numeric|between:-90,90',
            'site_longitude' => 'required|numeric|between:-180,180',
            'site_address' => 'required|string|max:255',
        ]);

        Setting::set('site_latitude', $request->site_latitude);
        Setting::set('site_longitude', $request->site_longitude);
        Setting::set('site_address', $request->site_address);

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
