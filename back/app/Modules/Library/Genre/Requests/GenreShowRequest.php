<?php

namespace App\Modules\Library\Genre\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GenreShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string', Rule::exists('genres', 'id')],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

}
