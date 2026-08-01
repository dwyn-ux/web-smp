<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    protected $fillable = ['title', 'description', 'image', 'sort_order'];

    public function getImageUrlAttribute()
    {
        $path = trim(str_replace('\\', '/', $this->image ?? ''), '/');

        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, 'assets/')) {
            return asset($path);
        }

        return asset('uploads/' . $path);
    }
}
