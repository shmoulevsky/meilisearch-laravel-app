<?php

namespace App\Modules\Library\Book\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
			'description' => $this->description,
			'author' => $this->author->name.' '.$this->author->last_name,
			'genres' => BookGenreResource::collection($this->genres),
			'rating' => $this->rating,
			'num_ratings' => $this->num_ratings,

        ];
    }
}
