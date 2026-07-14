<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'class_level',
        'address',
        'current_school',
        'current_university',
        'graduation_year',
        'message',
        'suggestion',
        'photo',
        'status',
        'show_on_homepage'
    ];

    protected function casts(): array
    {
        return [
            'graduation_year' => 'integer',
            'show_on_homepage' => 'boolean',
        ];
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getPhotoUrlAttribute()
    {
        $path = trim(str_replace('\\', '/', $this->photo ?? ''));

        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        // Bersihkan prefix storage/ (legacy) atau uploads/
        foreach (['storage/', 'uploads/'] as $prefix) {
            if (Str::startsWith($path, $prefix)) {
                $path = Str::after($path, $prefix);
                break;
            }
        }

        return asset('uploads/'.$path);
    }
}
