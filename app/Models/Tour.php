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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $query

            ->when(isset($filters['type']), function ($q) use ($filters) {
                $q->whereHas('category', function ($q2) use ($filters) {
                    $q2->where('slug', $filters['type']);
                });
            })

            ->when(isset($filters['destination']), function ($q) use ($filters) {
                $q->whereHas('destination', function ($q2) use ($filters) {
                    $q2->where('slug', $filters['destination']);
                });
            })

            ->when(isset($filters['price_min']), fn($q) =>
            $q->where('price_adult', '>=', $filters['price_min'])
            )

            ->when(isset($filters['price_max']), fn($q) =>
            $q->where('price_adult', '<=', $filters['price_max'])
            )

            ->when(isset($filters['duration']), fn($q) =>
            $q->where('duration_days', $filters['duration'])
            )

            ->when(isset($filters['language']), fn($q) =>
            $q->whereJsonContains('languages', $filters['language'])
            )

            ->when(isset($filters['rating']), fn($q) =>
            $q->where('rating', '>=', $filters['rating'])
            );
    }

}
