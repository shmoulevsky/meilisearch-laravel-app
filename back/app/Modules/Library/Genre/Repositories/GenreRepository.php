<?php

namespace App\Modules\Library\Genre\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use app\Modules\Library\Genre\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class GenreRepository extends BaseRepository
{
    public function __construct()
    {

    }

    public function getById(int|string|null $id) :?Model
    {

        return Genre::query()->where('id', $id)->first();
    }

    public function getList(string $sort, string $dir, string $count, array $filter) :?LengthAwarePaginator
    {
        $builder = Genre::query();

        if(isset($filter['q'])){
            $builder->where(function ($query) use ($filter){
               $query->where('name', 'ilike', '%'.$filter['q'].'%');
            });
        }

        return $builder->orderBy($sort, $dir)->paginate($count);
    }

    public function getByTitle(array $titles)
    {
        return Genre::query()
            ->whereIn('title', $titles)
            ->get();
    }
}
