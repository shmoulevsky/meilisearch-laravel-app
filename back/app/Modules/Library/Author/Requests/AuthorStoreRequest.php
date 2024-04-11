<?php

namespace App\Modules\Library\Author\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthorStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
        ];
    }

}
