<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="GenreItem",
 * )
 */
class GenreItem
{
    /**
     * @OA\Property(property="id", type="int", example="1", description="id")
     *
     * @var int $id
     */
    public int $id;

    /**
     * @OA\Property(property="title", type="string", example="Classics", description="title")
     *
     * @var string $title
     */
    public string $title;

    /**
     * @OA\Property(property="url", type="string", example="/books/genre/1", description="url")
     *
     * @var string $url
     */
    public string $url;


}
