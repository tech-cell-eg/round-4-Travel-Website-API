<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'image' =>  asset('/storage/' . $this->image_url),
            'content' => $this->content,
            'author' => $this->author,
            'tags' => $this->tags,
            'views_count' => $this->views_count,
            'published_at' => $this->published_at->format('M d, Y'),
        ];
    }
}
