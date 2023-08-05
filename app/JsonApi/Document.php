<?php

namespace App\JsonApi;

use Illuminate\Support\Collection;

class Document extends Collection
{
    public static function type(string $type): Document
    {
        return new self([
            'data' => ['type' => $type],
        ]);
    }

    public static function empty(): array
    {
        return [
            'data' => [],
        ];
    }

    public function id($id): Document
    {
        if ($id) {
            $this->items['data']['id'] = (string) $id;
        }

        return $this;
    }

    public function ids(Collection $resources): Document
    {
        $this->items['data'] = $resources->map(fn ($resource) => [
            'id' => (string) $resource->getRouteKey(),
            'type' => $resource->getResourceType(),
        ]);

        return $this;
    }

    public function attributes(array $attributes): Document
    {
        unset($attributes['_relationships']);

        $this->items['data']['attributes'] = $attributes;

        return $this;
    }


    public function relationshipData(array $relationships): Document
    {
        foreach ($relationships as $key => $relationship) {
            $this->items['data']['relationships'][$key]['data'] = [
                'type' => $relationship->getResourceType(),
                'id' => $relationship->getRouteKey(),
            ];
        }

        return $this;
    }

}
