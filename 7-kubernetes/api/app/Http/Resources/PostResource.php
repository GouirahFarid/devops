<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'headline' => $this->headline,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'publish_at' => $this->publish_at,
            'author' => UserResource::make($this->whenLoaded('author')),
            'cover_photo_url' => $this->when($request->has('with_cover'), fn () => $this->getCoverPhotoUrl()),
        ];
    }
}
