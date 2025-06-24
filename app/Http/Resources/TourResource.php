<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'destination' => $this->destination->name . ', ' . $this->destination->country,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'short_description' => str($this->overview)->limit(100),
            'features' => [
                'best_price_guarantee' => true,
                'free_cancellation' => true,
            ],
            'duration' => "{$this->duration_days} Days" . ($this->duration_days > 1 ? " 1 Night" : ""),
            'original_price' => rand(500, 1500),
            'discount_price' => $this->price_adult,
            'images' => $this->images->map(function ($image) {
                return asset('storage/' . $image->image_url);
            }),
        ];
    }
}
