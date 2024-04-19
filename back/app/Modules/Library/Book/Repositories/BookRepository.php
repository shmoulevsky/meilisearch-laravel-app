<?php

namespace App\Modules\Library\Book\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Library\Book\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Book();
    }

    public function getById(int|string|null $id) :?Model
    {

        return Book::query()->where('id', $id)->first();
    }

    public function getList(string $sort, string $dir, string $count, array $filter) :?LengthAwarePaginator
    {
        $builder = Book::query()->with(['author','genres']);

        if(isset($filter['q'])){
            $builder = Book::search($filter['q'])->query(function($query) {
                    $query->with(['author', 'genres']);
                });
        }

        return $builder->orderBy($sort, $dir)->paginate($count);
    }
}
