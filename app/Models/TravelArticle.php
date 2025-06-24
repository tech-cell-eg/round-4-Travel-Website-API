<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'image_url',
        'content', 'author', 'tags',
        'views_count', 'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];
}
