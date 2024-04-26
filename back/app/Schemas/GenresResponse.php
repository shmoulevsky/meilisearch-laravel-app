<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="GenresResponse",
 * )
 */
class GenresResponse
{
    /**
     * @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/GenreItem"))
     *
     *
     * @var array $data
     */
    public array $data;


}
