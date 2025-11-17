<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class TinyLinkFormRequests extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): Boolean
    {
        return true;
    }

    /**
     * Rules for validation
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'link' => 'required|url',
        ];
    }


    public function fields()
    {
        return [
            'origin_link' => $this->input('link'),
        ];
    }
}
