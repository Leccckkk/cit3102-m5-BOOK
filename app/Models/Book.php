<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'pages',
        'price',
    ];
    protected function casts(): array
    {
        return [
            'pages' => 'integer',
            'price' => 'decimal:2',
        ];
    }
}

