<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $request->getSchemeAndHttpHost() . '/' . $this->image,
            'title' => $this->title,
            'description' => $this->seo_description,
            'view' => $this->view_count,
            'category' => optional($this->category)->name ?? 'Unknown',
            'author' => optional(optional($this->employee)->user)->name ?? 'Unknown author',
            'slug' => $this->slug,
            'date' => $this->created_at->format('d M Y'),
        ];
    }
}
