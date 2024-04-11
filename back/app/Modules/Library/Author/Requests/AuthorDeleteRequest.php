<?php

namespace App\Modules\Library\Author\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthorDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string', Rule::exists('authors', 'id')],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
