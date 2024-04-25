<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Modules\Base\DTO\ParamListDTO;
use App\Modules\Library\Genre\Repositories\GenreRepository;
use App\Modules\Library\Genre\Resources\GenreCollection;
use App\Modules\Library\Genre\Services\GenreService;
use Illuminate\Http\Request;



class GenreController extends Controller
{

    public function __construct(
        public GenreService $genreService,
        public GenreRepository $genreRepository,
    )
    {
    }


    /**
     * @OA\Get(
     *     path="/api/v1/genres",
     *     summary="Get genres list",
     *     tags={"Genre"},
     *     operationId="GenreList",
     *     @OA\Parameter(
     *          name="q",
     *          in="query",
     *          example="Genre",
     *          description="query for search in title or text",
     *          required=false,
     *     ),

     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/GenresResponse"),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *     ),
     * )
     *
     */
    public function index(Request $request)
    {
        $genres = $this->genreRepository->getAll();
        return new GenreCollection($genres);
    }

}
