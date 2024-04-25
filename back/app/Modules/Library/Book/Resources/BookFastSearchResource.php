<?php

namespace App\Modules\Library\Book\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookFastSearchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => '/books/'.$this->id,
            'title' => $this->title,
			'author' => $this->author->name.' '.$this->author->last_name,
        ];
    }
}
