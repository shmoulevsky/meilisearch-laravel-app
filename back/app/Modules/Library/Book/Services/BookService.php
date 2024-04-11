<?php

namespace App\Modules\Library\Book\Services;

use App\Modules\Library\Book\DTO\BookDTO;
use App\Modules\Library\Book\Models\Book;
use App\Modules\Library\Book\Repositories\BookRepository;

class BookService
{
    public function __construct(
        public BookRepository $bookRepository
    )
    {
    }

    public function createOrUpdate(BookDTO $dto) :Book
    {
        $book = $this->bookRepository->getById($dto->id);

        if(empty($book)){
            $book = new Book();
        }

        $book->title = $dto->title;
		$book->description = $dto->description;
		$book->author_id = $dto->authorId;
		$book->rating = $dto->rating;
		$book->num_ratings = $dto->numRatings;
		
        $book->save();

        return $book;
    }

    public function delete(string $id) :void
    {
        $book = $this->bookRepository->getById($id);
        $book->delete();
    }

}
