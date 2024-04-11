<?php

namespace App\Modules\Library\Author\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Library\Author\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Author();
    }

    public function getById(int|string|null $id) :?Model
    {

        return Author::query()->where('id', $id)->first();
    }

    public function getList(string $sort, string $dir, string $count, array $filter) :?LengthAwarePaginator
    {
        $builder = Author::query();

        if(isset($filter['q'])){
            $builder->where(function ($query) use ($filter){
               $query->where('name', 'ilike', '%'.$filter['q'].'%');
            });
        }

        return $builder->orderBy($sort, $dir)->paginate($count);
    }

    public function getByName(string $name, string $lastName)
    {
        return Author::query()->where([
            ['name' ,$name],
            ['last_name', $lastName],
        ])->first();
    }
}
