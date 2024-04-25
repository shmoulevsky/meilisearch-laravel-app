<?php

namespace App\Modules\Library\Book\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Library\Book\Models\Book;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Meilisearch\Endpoints\Indexes;

class BookRepository extends BaseRepository
{
    const FAST_SEARCH_LIMIT = 10;

    public function __construct()
    {
        $this->model = new Book();
    }

    public function getById(?int $id) :?Model
    {
        return Book::query()->with(['author','genres'])->where('id', $id)->first();
    }

    public function getList(string $sort, string $dir, int $count, array $filter) :?LengthAwarePaginator
    {

        $q = '';
        $builder = Book::query();

        if(isset($filter['q'])){
            $q = $filter['q'];
        }

        $rawSearch = Book::search($q, function(Indexes $meilisearch, string $q, array $options) use ($count, $filter){

            if(isset($filter['genre_id'])){
                $options['filter'][] = 'genre_id='.$filter['genre_id'];
            }

            if(isset($filter['genres'])){

                $genreFilter = '';

                foreach (explode(',', $filter['genres']) as $key => $genre){
                    $and = 'AND';
                    if($key === 0) $and = '';
                    $genreFilter .= $and.'(genre_id='.$genre.')';
                }
                $options['filter'][] = $genreFilter;
            }

            if(isset($filter['author_id'])){
                $options['filter'][] = 'author_id='.$filter['author_id'];
            }

            return $meilisearch->search($q, $options);

        })->paginateRaw();

        $ids = array_column($rawSearch->items()['hits'], 'id');

        $products = $builder->with(['genres','author'])
            ->whereIn('id', $ids)
            ->orderBy($sort, $dir)
            ->get();

        return  new LengthAwarePaginator(
            $products, $rawSearch->total(), $rawSearch->perPage(), $rawSearch->currentPage(), []);
    }

    public function fastSearch(string $q) :?Collection
    {
        $builder = Book::search($q, function(Indexes $meilisearch, string $q, array $options){

            $options['limit'] = self::FAST_SEARCH_LIMIT;
            return $meilisearch->search($q, $options);

        })->query(function($query) {
            $query->with(['author']);
        });

        return $builder->get();
    }
}
