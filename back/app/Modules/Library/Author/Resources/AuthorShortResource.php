<?php

namespace App\Modules\Library\Author\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AuthorShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
			'last_name' => $this->last_name,
			
        ];
    }
}
