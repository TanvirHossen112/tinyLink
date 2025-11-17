<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function fields()
    {
        return [
            'email' => $this->input('email'),
            'password' => $this->input('password')
        ];
    }
}
