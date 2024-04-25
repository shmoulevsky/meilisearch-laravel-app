<?php

namespace App\Modules\Library\Book\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookGenreResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => '/books/genre/'.$this->id,
        ];
    }
}
