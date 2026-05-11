<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'published'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
