<?php

namespace App\Schemas;


/**
 * @OA\Schema(
 *     description="Desc",
 *     type="object",
 *     title="AuthorUpdateRequest",
 * )
 */
class AuthorUpdateRequest
{
    /**
     * @OA\Property(property="name", type="string", example="Eugeny", description="name")
     *
     * @var string $name
     */
    public string $name;

    /**
     * @OA\Property(property="last_name", type="string", example="Shmoulevsky", description="last_name")
     *
     * @var string $last_name
     */
    public string $last_name;


}
