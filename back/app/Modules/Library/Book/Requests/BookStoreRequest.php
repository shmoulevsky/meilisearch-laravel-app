<?php

namespace App\Modules\Library\Book\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:30'],
            'author_id' => ['required', Rule::exists('authors', 'id')],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'num_ratings' => ['required', 'integer', 'min:0'],
        ];
    }

}
