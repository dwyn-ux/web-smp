<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Alumni;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)->latest()->take(3)->get();
        $alumni = Alumni::approved()->latest()->take(6)->get();
        return view('home', compact('articles', 'alumni'));
    }

    public function profile()
    {
        return view('profil');
    }
}
