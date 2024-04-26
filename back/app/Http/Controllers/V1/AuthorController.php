<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Modules\Base\DTO\ParamListDTO;
use App\Modules\Base\Resources\ErrorResource;
use App\Modules\Base\Resources\SuccessResource;
use App\Modules\Library\Author\DTO\AuthorDTO;
use App\Modules\Library\Author\Repositories\AuthorRepository;
use App\Modules\Library\Author\Requests\AuthorDeleteRequest;
use App\Modules\Library\Author\Requests\AuthorShowRequest;
use App\Modules\Library\Author\Requests\AuthorStoreRequest;
use App\Modules\Library\Author\Requests\AuthorUpdateRequest;
use App\Modules\Library\Author\Resources\AuthorCollection;
use App\Modules\Library\Author\Resources\AuthorResource;
use App\Modules\Library\Author\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthorController extends Controller
{

    public function __construct(
        public AuthorService $authorService,
        public AuthorRepository $authorRepository,
    )
    {
    }


    /**
     * @OA\Get(
     *     path="/api/v1/authors",
     *     summary="Get authors list",
     *     tags={"Author"},
     *     operationId="AuthorList",
     *     @OA\Parameter(
     *          name="q",
     *          in="query",
     *          example="Author",
     *          description="query for search in title or text",
     *          required=false,
     *     ),

     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/AuthorsResponse"),
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

        $authors = $this->authorRepository->getList(
            $params->getSort(),
            $params->getDir(),
            $params->getCount(),
            $params->getFilter()
        );
        return new AuthorCollection($authors);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/author/{id}",
     *     summary="Get author by id",
     *     tags={"Author"},
     *     operationId="AuthorShow",
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/AuthorResponse"),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error",
     *     ),
     * )
     */
    public function show(AuthorShowRequest $request)
    {
        $author = $this->authorRepository->getById($request->id, Auth::id());
        return new AuthorResource($author);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/authors",
     *     summary="Store author",
     *     tags={"Author"},
     *     operationId="AuthorStore",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthorStoreRequest")
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
    public function store(AuthorStoreRequest $request)
    {
        $dto = new AuthorDTO(
            null,
            $request->name,
			$request->last_name,

        );

        $author = $this->authorService->createOrUpdate($dto);
        return new SuccessResource($author);
    }

    /**
     * @OA\Patch (
     *     path="/api/v1/authors/{id}",
     *     summary="Update author",
     *     tags={"Author"},
     *     operationId="AuthorUpdate",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthorUpdateRequest")
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
    public function update(AuthorUpdateRequest $request)
    {
        $dto = new AuthorDTO(
            $request->id,
            $request->name,
			$request->last_name,

        );

        $author = $this->authorService->createOrUpdate($dto);
        return new SuccessResource($author);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/auth/author/{id}",
     *     summary="Delete author by id",
     *     tags={"Author"},
     *     operationId="AuthorDelete",
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
    public function delete(AuthorDeleteRequest $request)
    {
        try{
            $this->authorService->delete($request->id);
        }catch (\Exception $exception){
            return new ErrorResource($exception);
        }

        return new SuccessResource(null);
    }

}
