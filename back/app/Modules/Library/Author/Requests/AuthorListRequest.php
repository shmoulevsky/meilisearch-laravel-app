<?php

namespace App\Modules\Library\Author\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthorListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'int'],
            'sort' => ['nullable', 'string'],
            'dir' => ['nullable', 'string'],
            'filter' => ['nullable', 'array'],
        ];
    }


}
