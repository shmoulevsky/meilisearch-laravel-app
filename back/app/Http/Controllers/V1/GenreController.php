<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Base\DTO\ParamListDTO;
use App\Modules\Base\Resources\ErrorResource;
use App\Modules\Base\Resources\SuccessResource;
use App\Modules\Library\Genre\DTO\GenreDTO;
use App\Modules\Library\Genre\Repositories\GenreRepository;
use App\Modules\Library\Genre\Requests\GenreDeleteRequest;
use App\Modules\Library\Genre\Requests\GenreShowRequest;
use App\Modules\Library\Genre\Requests\GenreStoreRequest;
use App\Modules\Library\Genre\Requests\GenreUpdateRequest;
use App\Modules\Library\Genre\Resources\GenreCollection;
use App\Modules\Library\Genre\Resources\GenreResource;
use App\Modules\Library\Genre\Services\GenreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $params = ParamListDTO::fromRequest($request);

        $genres = $this->genreRepository->getList(
            $params->getSort(),
            $params->getDir(),
            $params->getCount(),
            $params->getFilter()
        );
        return new GenreCollection($genres);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/genre/{id}",
     *     summary="Get genre by id",
     *     tags={"Genre"},
     *     operationId="GenreShow",
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/GenreResponse"),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error",
     *     ),
     * )
     */
    public function show(GenreShowRequest $request)
    {
        $genre = $this->genreRepository->getById($request->id, Auth::id());
        return new GenreResource($genre);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/genres",
     *     summary="Store genre",
     *     tags={"Genre"},
     *     operationId="GenreStore",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/GenresStoreRequest")
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse"),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *     ),
     * )
     *
     */
    public function store(GenreStoreRequest $request)
    {
        $dto = new GenreDTO(
            null,
            $request->title,
			
        );

        $genre = $this->genreService->createOrUpdate($dto);
        return new SuccessResource($genre);
    }

    /**
     * @OA\Patch (
     *     path="/api/v1/genres/{id}",
     *     summary="Update genre",
     *     tags={"Genre"},
     *     operationId="GenreUpdate",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/GenreUpdateRequest")
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse"),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *     ),
     * )
     *
     */
    public function update(GenreUpdateRequest $request)
    {
        $dto = new GenreDTO(
            $request->id,
            $request->title,
			
        );

        $genre = $this->genreService->createOrUpdate($dto);
        return new SuccessResource($genre);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/auth/genre/{id}",
     *     summary="Delete genre by id",
     *     tags={"Genre"},
     *     operationId="GenreDelete",
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse"),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error",
     *     ),
     * )
     */
    public function delete(GenreDeleteRequest $request)
    {
        try{
            $this->genreService->delete(Auth::id(), $request->id);
        }catch (\Exception $exception){
            return new ErrorResource($exception);
        }

        return new SuccessResource(null);
    }

}
