<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="BookUpdateRequest",
 * )
 */
class BookUpdateRequest
{
    /**
     * @OA\Property(property="title", type="string", example="Some book", description="title")
     *
     * @var string $title
     */
    public string $title;

    /**
     * @OA\Property(property="description", type="string", example="Some book description of some book description", description="description")
     *
     * @var string $description
     */
    public string $description;

    /**
     * @OA\Property(property="author_id", type="int", example="1", description="author_id")
     *
     * @var int $author_id
     */
    public int $author_id;

    /**
     * @OA\Property(property="rating", type="int", example="5", description="rating")
     *
     * @var int $rating
     */
    public int $rating;

    /**
     * @OA\Property(property="num_ratings", type="int", example="1000", description="num_ratings")
     *
     * @var int $num_ratings
     */
    public int $num_ratings;


}
