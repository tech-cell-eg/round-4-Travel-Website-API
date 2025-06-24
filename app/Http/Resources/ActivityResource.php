<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'image' =>  asset('/storage/' . $this->image_url),

            $this->mergeWhen(
                $request->routeIs('activities.byDestination'),
                [
                    'destination' => [
                        'slug' => $this->destination->slug ?? null,
                        'country' => $this->destination->country ?? null,
                    ],                ]
            ),

            $this->mergeWhen(
                $request->routeIs('activities.show'),
                [
                    'description' => $this->description,
                    'price' => $this->price,
                    'rating' => $this->rating,
                    'review_count' => $this->review_count,
                    'destination' => [
                        'slug' => $this->destination->slug ?? null,
                        'country' => $this->destination->country ?? null,
                    ],
                ]
            ),

        ];
    }

}
