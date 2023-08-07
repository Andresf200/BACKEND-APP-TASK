<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\JsonApi\Traits\JsonApiResource;
use App\Http\Resources\CheckListsResource;

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
            'date_end' => $this->resource->date_end,
            'checklist_completed' => $this->resource->checklists->where('completed', true)->count(),
            'checklist' => $this->resource->checklists->count()
        ];
    }

    public function getIncludes(): array
    {
        return [
            'checklists' => CheckListsResource::make($this->whenLoaded('checklists')),
            'user' => UsersResource::make($this->whenLoaded('user')),
            'files' => TasksFilesResource::make($this->whenLoaded('files')),
        ];
    }

}
