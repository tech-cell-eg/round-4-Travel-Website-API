<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'avatar' => asset('storage/' . $this->image_url),
            'title' => $this->title,
            'message' => $this->message,
        ];
    }

}
