<?php

namespace App\Modules\Library\Genre\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Library\Genre\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class GenreRepository extends BaseRepository
{
    public function __construct()
    {

    }

    public function getById(int|string|null $id) :?Model
    {

        return Genre::query()->where('id', $id)->first();
    }

    public function getAll() :?Collection
    {
        $builder = Genre::query()->withCount('books');

        return $builder->whereHas('books')->orderBy('title')->get();
    }

    public function getByTitle(array $titles)
    {
        return Genre::query()
            ->whereIn('title', $titles)
            ->get();
    }
}
