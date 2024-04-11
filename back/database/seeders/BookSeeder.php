<?php

namespace Database\Seeders;

use App\Modules\Library\Author\DTO\AuthorDTO;
use App\Modules\Library\Author\Services\AuthorService;
use App\Modules\Library\Book\DTO\BookDTO;
use App\Modules\Library\Book\Services\BookService;
use App\Modules\Library\Genre\Models\Genre;
use App\Modules\Library\Genre\Repositories\GenreRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{

    public function __construct(
        protected AuthorService $authorService,
        protected BookService $bookService,
        protected GenreRepository $genreRepository,
    )
    {
    }


    public function run(): void
    {
        $csv= fopen(__DIR__ . '/data/goodreads_data.csv', 'r');

        $this->storeGenres($csv);
        rewind($csv);

        $this->storeBooks($csv);

    }

    private function storeGenres($csv)
    {
        $genres = [];
        $genreExist = [];
        $index = 0;

        while (($row = fgetcsv($csv)) !== false) {

            if(empty($row[4]) || $index === 0) {
                $index++;
                continue;
            }

            $bookGenres = str_replace(array( '[', ']', '\''), '', $row[4]);
            $bookGenres = explode(',',trim($bookGenres));

            foreach ($bookGenres as $bookGenre){
                if(!in_array($bookGenre, $genreExist)){
                    $genreExist[] = $bookGenre;
                    $genres[] = [
                        'title' => $bookGenre,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            $index++;
            dump($index);
        }

        Genre::query()->insert($genres);


    }

    private function storeBooks($csv)
    {
        $index = 0;

        while (($row = fgetcsv($csv)) !== false) {

            try {

                dump($row[2]);

                if(empty($row[2]) || $index === 0) {
                    $index++;
                    continue;
                }

                list($name, $lastName) = explode(' ',trim($row[2]));

                $authorDto = new AuthorDTO(null, $name, $lastName);
                $author = $this->authorService->createOrUpdate($authorDto);

                $bookDto = new BookDTO(
                    null,
                    $row[1],
                    $row[3],
                    $author->id,
                    (float)$row[5],
                    (int)$row[6],
                );


                $book = $this->bookService->createOrUpdate($bookDto);

                $bookGenres = str_replace(array( '[', ']', '\''), '', $row[4]);
                $bookGenres = array_map('trim', explode(',',trim($bookGenres)));

                $bookGenreIds = $this->genreRepository
                    ->getByTitle($bookGenres)
                    ->pluck('id')
                    ->toArray();

                $book->genres()->sync($bookGenreIds);

            } catch (\Exception $e) {
                dump($e);
                Log::alert($e);
                continue;
            }

        }
    }
}
