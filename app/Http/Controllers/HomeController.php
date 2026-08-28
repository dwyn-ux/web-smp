<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Alumni;
use App\Models\Facility;
use App\Models\Setting;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)->latest()->take(3)->get();
        $alumni = Alumni::approved()->where('show_on_homepage', true)->latest()->take(6)->get();

        try {
            $facilities = Facility::orderBy('sort_order')->get();
        } catch (\Throwable) {
            $facilities = new Collection();
        }
        $latitude = Setting::get('site_latitude', '-7.8237589');
        $longitude = Setting::get('site_longitude', '110.6330109');
        $address = Setting::get('site_address', 'SMP Muhammadiyah Unggulan Ashidiq');

        $photos = [
            'logo' => Setting::get('site_logo', 'assets/logo smp.png'),
            'kegiatan_1' => Setting::get('site_kegiatan_1', 'assets/kegiatan-1.jpg'),
            'kegiatan_2' => Setting::get('site_kegiatan_2', 'assets/kegiatan-2.jpg'),
            'kegiatan_3' => Setting::get('site_kegiatan_3', 'assets/kegiatan-3.jpg'),
            'kegiatan_4' => Setting::get('site_kegiatan_4', 'assets/kegiatan-4.jpg'),
            'program_tahfidz' => Setting::get('site_program_tahfidz', 'assets/program-tahfidz.jpg'),
            'program_akademik' => Setting::get('site_program_akademik', 'assets/program-akademik.jpg'),
            'program_ekskul' => Setting::get('site_program_ekskul', 'assets/program-ekskul.jpg'),
        ];

        return view('home', compact('articles', 'alumni', 'facilities', 'latitude', 'longitude', 'address', 'photos'));
    }

    public function profile()
    {
        $photos = [
            'hero' => Setting::get('site_profil_hero', 'assets/sekolah.jpg'),
            'tentang' => Setting::get('site_profil_tentang', 'assets/tentang.jpg'),
        ];

        return view('profil', compact('photos'));
    }
}
