<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'title',
        'overview',
        'duration_days',
        'group_size',
        'age',
        'languages',
        'highlights',
        'included',
        'itinerary',
        'notes',
        'price_adult',
        'price_youth',
        'price_child',
        'extra_service_booking',
        'extra_service_adult',
        'extra_service_youth',
        'available_from',
        'available_to',
        'rating',
        'review_count',
        'slug',
    ];

    protected $casts = [
        'age' => 'array',
        'languages' => 'array',
        'highlights' => 'array',
        'included' => 'array',
        'itinerary' => 'array',
        'notes' => 'array',
        'available_from' => 'date',
        'available_to' => 'date',
        'price_adult' => 'float',
        'price_youth' => 'float',
        'price_child' => 'float',
        'extra_service_booking' => 'float',
        'extra_service_adult' => 'float',
        'extra_service_youth' => 'float',
        'rating' => 'float',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }
}
