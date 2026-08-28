<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = null): ?string
    {
        try {
            return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
                return static::where('key', $key)->value('value') ?? $default;
            });
        } catch (\Throwable) {
            return $default;
        }
    }

    public static function set(string $key, ?string $value): void
    {
        try {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget("setting.{$key}");
        } catch (\Throwable) {
            // Table may not exist yet; silently ignore.
        }
    }

    protected static function booted(): void
    {
        static::saved(function (self $setting) {
            Cache::forget("setting.{$setting->key}");
        });
    }
}
