<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Base\DTO\ParamListDTO;
use App\Modules\Base\Resources\ErrorResource;
use App\Modules\Base\Resources\SuccessResource;
use App\Modules\Library\Book\DTO\BookDTO;
use App\Modules\Library\Book\Repositories\BookRepository;
use App\Modules\Library\Book\Requests\BookDeleteRequest;
use App\Modules\Library\Book\Requests\BookShowRequest;
use App\Modules\Library\Book\Requests\BookStoreRequest;
use App\Modules\Library\Book\Requests\BookUpdateRequest;
use App\Modules\Library\Book\Resources\BookCollection;
use App\Modules\Library\Book\Resources\BookResource;
use App\Modules\Library\Book\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

    public function __construct(
        public BookService $bookService,
        public BookRepository $bookRepository,
    )
    {
    }


    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     summary="Get books list",
     *     tags={"Book"},
     *     operationId="BookList",
     *     @OA\Parameter(
     *          name="q",
     *          in="query",
     *          example="Book",
     *          description="query for search in title or text",
     *          required=false,
     *     ),

     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/BooksResponse"),
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

        $books = $this->bookRepository->getList(
            $params->getSort(),
            $params->getDir(),
            $params->getCount(),
            $params->getFilter()
        );
        return new BookCollection($books);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/book/{id}",
     *     summary="Get book by id",
     *     tags={"Book"},
     *     operationId="BookShow",
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/BookResponse"),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error",
     *     ),
     * )
     */
    public function show(BookShowRequest $request)
    {
        $book = $this->bookRepository->getById($request->id, Auth::id());
        return new BookResource($book);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/books",
     *     summary="Store book",
     *     tags={"Book"},
     *     operationId="BookStore",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BooksStoreRequest")
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
    public function store(BookStoreRequest $request)
    {
        $dto = new BookDTO(
            null,
            $request->title,
			$request->description,
			$request->author_id,
			$request->rating,
			$request->num_ratings,
			
        );

        $book = $this->bookService->createOrUpdate($dto);
        return new SuccessResource($book);
    }

    /**
     * @OA\Patch (
     *     path="/api/v1/books/{id}",
     *     summary="Update book",
     *     tags={"Book"},
     *     operationId="BookUpdate",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookUpdateRequest")
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
    public function update(BookUpdateRequest $request)
    {
        $dto = new BookDTO(
            $request->id,
            $request->title,
			$request->description,
			$request->author_id,
			$request->rating,
			$request->num_ratings,
			
        );

        $book = $this->bookService->createOrUpdate($dto);
        return new SuccessResource($book);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/auth/book/{id}",
     *     summary="Delete book by id",
     *     tags={"Book"},
     *     operationId="BookDelete",
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
    public function delete(BookDeleteRequest $request)
    {
        try{
            $this->bookService->delete(Auth::id(), $request->id);
        }catch (\Exception $exception){
            return new ErrorResource($exception);
        }

        return new SuccessResource(null);
    }

}