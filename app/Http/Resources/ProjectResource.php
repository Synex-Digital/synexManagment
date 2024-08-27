<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'image'         => $request->getSchemeAndHttpHost() . '/' . $this->thumbnail_image,
            'title'         => $this->title,
            'description'   => $this->short_description,
            'name'          => $this->company_name,
            'slug'          => $this->slug,
            'category'      => $this->category ? $this->category->name : 'TrustedMember',
            'date'          => $this->created_at->format('d M Y'),
        ];
    }
}
