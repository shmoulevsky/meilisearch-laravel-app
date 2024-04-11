<?php

namespace App\Modules\Library\Book\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string', Rule::exists('books', 'id')],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

}
