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
			'author_id' => $this->author_id,
			'rating' => $this->rating,
			'num_ratings' => $this->num_ratings,
			
        ];
    }
}
