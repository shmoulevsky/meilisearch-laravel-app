<?php

namespace App\Modules\Library\Book\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => BookShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
