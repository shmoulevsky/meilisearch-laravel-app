<?php

namespace App\Modules\Library\Book\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author->name.' '.$this->author->last_name,
            'author_url' => '/books/author/'.$this->author->id,
            'genres' => BookGenreResource::collection($this->genres),
            'rating' => $this->rating,
            'num_ratings' => $this->num_ratings,
        ];
    }
}
