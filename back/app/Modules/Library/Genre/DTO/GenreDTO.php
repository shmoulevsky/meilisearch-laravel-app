<?php

namespace App\Modules\Library\Genre\DTO;

class GenreDTO
{
    public function __construct(
        public int|string|null $id,
        public string $title,
		
    )
    {
    }
}
