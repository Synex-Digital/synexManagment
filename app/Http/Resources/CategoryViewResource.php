<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            's_title' => $this->seo_title,
            's_description' => $this->seo_description,
            's_tags' => $this->seo_tags,
            'date' => $this->created_at->format('d M Y'),
        ];
    }
}
