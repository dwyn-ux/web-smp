<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    protected $fillable = ['title', 'category', 'file', 'type', 'size', 'thumbnail'];

    protected $appends = ['file_url', 'thumbnail_url'];

    public function getFileUrlAttribute()
    {
        return $this->resolveUrl($this->file);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->resolveUrl($this->thumbnail);
    }

    protected function resolveUrl($value)
    {
        $path = trim(str_replace('\\', '/', $value ?? ''), '/');

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
