<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)->latest()->take(3)->get();
        return view('home', compact('articles'));
    }

    public function profile()
    {
        return view('profil');
    }
}
