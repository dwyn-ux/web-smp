<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Alumni;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)->latest()->take(3)->get();
        $alumni = Alumni::approved()->where('show_on_homepage', true)->latest()->take(6)->get();
        $latitude = Setting::get('site_latitude', '-7.8237589');
        $longitude = Setting::get('site_longitude', '110.6330109');
        $address = Setting::get('site_address', 'SMP Muhammadiyah Unggulan Ashidiq');

        return view('home', compact('articles', 'alumni', 'latitude', 'longitude', 'address'));
    }

    public function profile()
    {
        return view('profil');
    }
}
