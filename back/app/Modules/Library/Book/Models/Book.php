<?php

namespace App\Modules\Library\Book\Models;

use App\Modules\Library\Author\Models\Author;
use App\Modules\Library\Genre\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'genre_id' => $this->genres->pluck('id'),
            'author_id' => $this->author_id,
            'author' => $this->author->last_name.' '.$this->author->name
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'books_genre');
    }

}
