<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\Resource;

class  BlogResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'created_by' => $this->CreatedBy,
            'updated_by' => $this->UpdatedBy,
            'description' => $this->description,
            'category' => $this->Category,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];

    }
}
