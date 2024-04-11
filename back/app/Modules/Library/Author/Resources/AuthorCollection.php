<?php

namespace App\Modules\Library\Author\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => AuthorShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
