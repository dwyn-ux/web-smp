<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = ['title', 'image'];

    public function getImageUrlAttribute()
    {
        $path = trim(str_replace('\\', '/', $this->image ?? ''), '/');

        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // Bersihkan prefix storage/ (legacy) atau uploads/
        foreach (['storage/', 'uploads/'] as $prefix) {
            if (Str::startsWith($path, $prefix)) {
                $path = Str::after($path, $prefix);
                break;
            }
        }

        return asset('uploads/' . $path);
    }
}
