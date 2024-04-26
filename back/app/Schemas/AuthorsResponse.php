<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="AuthorsResponse",
 * )
 */
class AuthorsResponse
{
    /**
     * @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/AuthorShortItem"))
     *
     *
     * @var array $data
     */
    public array $data;


}
