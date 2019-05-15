<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'is_public',
    ];
}
