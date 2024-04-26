<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="BooksResponse",
 * )
 */
class BooksResponse
{
    /**
     * @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/BookShortItem"))
     *
     *
     * @var array $data
     */
    public array $data;


}
