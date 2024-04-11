<?php

namespace App\Modules\Library\Book\DTO;

class BookDTO
{
    public function __construct(
        public ?int $id,
        public string $title,
		public ?string $description,
		public int $authorId,
		public ?float $rating,
		public ?int $numRatings,

    )
    {
    }
}
