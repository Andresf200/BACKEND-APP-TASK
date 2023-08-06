<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckListsResource extends JsonResource
{

    use JsonApiResource;
    public function toJsonApi():array
    {
        return [
            'id' => $this->resource->id,
            'item' => $this->resource->item,
            'completed' => $this->resource->completed,
            'task_id' => $this->resource->task_id,
        ];
    }
}
