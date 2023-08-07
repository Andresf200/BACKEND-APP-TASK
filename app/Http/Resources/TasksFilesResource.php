<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksFilesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'file_name' => $this->resource->file_name,
            'file_path' => $this->resource->file_path,
            'task_id' => $this->resource->task_id
        ];
    }
}
