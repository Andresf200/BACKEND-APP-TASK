<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'state' => $this->resource->state,
            'date_start' => $this->resource->date_start,
            'date_end' => $this->resource->date_end
        ];
    }
}
