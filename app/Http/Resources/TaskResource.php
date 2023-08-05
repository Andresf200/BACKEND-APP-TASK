<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\JsonApi\Traits\JsonApiResource;

class TaskResource extends JsonResource
{
    use JsonApiResource;
    public function toJsonApi():array
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

    public function getIncludes(): array
    {
        return [
            CheckListsResource::make($this->whenLoaded('checklists')),
        ];
    }

}
