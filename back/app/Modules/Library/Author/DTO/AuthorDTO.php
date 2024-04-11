<?php

namespace App\Modules\Library\Author\DTO;

class AuthorDTO
{
    public function __construct(
        public int|string|null $id,
        public string $name,
		public string $lastName,
		
    )
    {
    }
}
