<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id', 'title', 'slug', 'image_url',
        'description', 'price', 'rating', 'review_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'review_count' => 'integer',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
