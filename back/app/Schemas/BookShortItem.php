<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="BookShortItem",
 * )
 */
class BookShortItem
{
    /**
     * @OA\Property(property="id", type="int", example="29", description="id")
     *
     * @var int $id
     */
    public int $id;

    /**
     * @OA\Property(property="title", type="string", example="Alice's Adventures in Wonderland / Through the Looking-Glass", description="title")
     *
     * @var string $title
     */
    public string $title;

    /**
     * @OA\Property(property="url", type="string", example="/books/29", description="url")
     *
     * @var string $url
     */
    public string $url;

    /**
     * @OA\Property(property="author", type="string", example="Lewis Carroll", description="author")
     *
     * @var string $author
     */
    public string $author;

    /**
     * @OA\Property(property="author_url", type="string", example="/books/author/25", description="author_url")
     *
     * @var string $author_url
     */
    public string $author_url;

    /**
     * @OA\Property(property="rating", type="string", example="4.06", description="rating")
     *
     * @var string $rating
     */
    public string $rating;

    /**
     * @OA\Property(property="num_ratings", type="int", example="536", description="num_ratings")
     *
     * @var int $num_ratings
     */
    public int $num_ratings;

    /**
     * @OA\Property(
     *      property="genres",
     *      type="array",
     *       @OA\Items(ref="#/components/schemas/GenreItem"))
     *      description="genres"
     * )
     */
    public array $genres;


}
