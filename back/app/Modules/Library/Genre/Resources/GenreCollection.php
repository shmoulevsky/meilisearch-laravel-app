<?php

namespace App\Modules\Library\Genre\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GenreCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => GenreShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
