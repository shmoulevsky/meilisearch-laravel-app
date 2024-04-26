<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="AuthorShortItem",
 * )
 */
class AuthorResponse
{
    /**
     * @OA\Property(property="id", type="int", example="7", description="id")
     *
     * @var int $id
     */
    public int $id;

    /**
     * @OA\Property(property="name", type="string", example="Jas", description="name")
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(property="last_name", type="string", example="T.", description="last_name")
     *
     * @var string $last_name
     */
    public string $last_name;


}
