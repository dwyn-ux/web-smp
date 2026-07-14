<?php

namespace Tests\Feature;

use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_photos_with_the_same_title_are_presented_as_one_album(): void
    {
        Gallery::create(['title' => 'Kegiatan Sekolah', 'image' => 'gallery/satu.jpg']);
        Gallery::create(['title' => 'Kegiatan Sekolah', 'image' => 'gallery/dua.jpg']);
        Gallery::create(['title' => 'Album Lain', 'image' => 'gallery/tiga.jpg']);

        $response = $this->get(route('galeri.index'));

        $response->assertOk();
        $response->assertViewHas('albums', function ($albums) {
            $schoolAlbum = $albums->getCollection()->firstWhere('title', 'Kegiatan Sekolah');

            return $albums->total() === 2
                && $schoolAlbum !== null
                && $schoolAlbum['photos']->count() === 2;
        });
    }
}
