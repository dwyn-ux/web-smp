<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class GalleryController extends Controller
{
    public function index()
    {
        $perPage = 12;
        $currentPage = Paginator::resolveCurrentPage();

        // Satu judul mewakili satu album. Setiap foto yang di-upload sekaligus
        // memang disimpan sebagai baris terpisah dengan judul yang sama.
        $albumCollection = Gallery::latest()
            ->get()
            ->groupBy(fn (Gallery $gallery) => mb_strtolower(trim($gallery->title)))
            ->map(function ($photos) {
                $cover = $photos->first();

                return [
                    'title' => $cover->title,
                    'cover' => $cover->image_url ?? asset('assets/logo smp.png'),
                    'photos' => $photos->map(fn (Gallery $photo) => [
                        'image' => $photo->image_url ?? asset('assets/logo smp.png'),
                        'title' => $photo->title,
                    ])->values(),
                ];
            })
            ->values();

        $albums = new LengthAwarePaginator(
            $albumCollection->forPage($currentPage, $perPage)->values(),
            $albumCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('galeri', compact('albums'));
    }
}
