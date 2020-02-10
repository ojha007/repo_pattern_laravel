<?php

namespace App\Resources\Resource;

use Illuminate\Http\Resources\Json\Resource;

class  ProductResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'category' => $this->ProductCategory,
            'unit' => $this->Unit,
            'reference_number' => $this->reference_number,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];

    }
}
