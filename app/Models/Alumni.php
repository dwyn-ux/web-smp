<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'class_level',
        'address',
        'current_school',
        'message',
        'suggestion',
        'photo',
        'status'
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
