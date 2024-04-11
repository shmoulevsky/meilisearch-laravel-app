<?php

namespace App\Modules\Library\Author\Services;

use App\Modules\Library\Author\DTO\AuthorDTO;
use App\Modules\Library\Author\Models\Author;
use App\Modules\Library\Author\Repositories\AuthorRepository;

class AuthorService
{
    public function __construct(
        public AuthorRepository $authorRepository
    )
    {
    }

    public function createOrUpdate(AuthorDTO $dto) :Author
    {
        $author = $this->authorRepository->getById($dto->id);

        if(empty($author)){
            $author = $this->authorRepository->getByName($dto->name, $dto->lastName);
        }

        if(empty($author)){
            $author = new Author();
        }

        $author->name = $dto->name;
		$author->last_name = $dto->lastName;

        $author->save();

        return $author;
    }

    public function delete(string $id) :void
    {
        $author = $this->authorRepository->getById($id);
        $author->delete();
    }

}
