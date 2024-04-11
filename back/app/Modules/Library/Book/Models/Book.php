<?php

namespace app\Modules\Library\Book\Models;

use app\Modules\Library\Genre\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'books_genre');
    }

}
