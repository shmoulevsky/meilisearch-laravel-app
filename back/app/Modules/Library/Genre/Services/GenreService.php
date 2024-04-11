<?php

namespace App\Modules\Library\Genre\Services;

use App\Modules\Library\Genre\DTO\GenreDTO;
use app\Modules\Library\Genre\Models\Genre;
use App\Modules\Library\Genre\Repositories\GenreRepository;

class GenreService
{
    public function __construct(
        public GenreRepository $genreRepository
    )
    {
    }

    public function createOrUpdate(GenreDTO $dto) :Genre
    {
        $genre = $this->genreRepository->getById($dto->id);

        if(empty($genre)){
            $genre = new Genre();
        }

        $genre->title = $dto->title;

        $genre->save();

        return $genre;
    }

    public function delete(string $id) :void
    {
        $genre = $this->genreRepository->getById($id);
        $genre->delete();
    }

}
