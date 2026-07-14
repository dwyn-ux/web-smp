<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniGraduationYear extends Model
{
    protected $fillable = [
        'year',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }
}
