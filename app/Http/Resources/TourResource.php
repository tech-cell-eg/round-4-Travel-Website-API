<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'category' => $this->category->name ?? null,
            'destination' => $this->destination->name . ', ' . $this->destination->country,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'short_description' => str($this->overview)->limit(100),
            'features' => [
                'best_price_guarantee' => true,
                'free_cancellation' => true,
            ],
            'duration' => "{$this->duration_days} Days" . ($this->duration_days > 1 ? " 1 Night" : ""),
            'original_price' => $this->price_adult,
            'discount_price' => $this->price_adult * 0.75,
            'images' => $this->images->map(fn ($image) =>
            asset('storage/' . $image->image_url)
            ),

            $this->mergeWhen(
                $request->routeIs('tours.show'),
                [
                    'overview' => $this->overview,
                    'group_size' => $this->group_size,
                    'age' => $this->age,
                    'languages' => $this->languages,
                    'included' => $this->included,
                    'itinerary' => $this->itinerary,
                    'notes' => $this->notes,
                    'price' => [
                        'adult' => $this->price_adult,
                        'youth' => $this->price_youth,
                        'child' => $this->price_child,
                    ],
                    'extra_services' => [
                        'booking' => $this->extra_service_booking,
                        'adult' => $this->extra_service_adult,
                        'youth' => $this->extra_service_youth,
                    ],
                    'available_from' => $this->available_from?->toDateString(),
                    'available_to' => $this->available_to?->toDateString(),
                ]
            ),
        ];
    }
}
