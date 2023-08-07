<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
        ];
    }
}
