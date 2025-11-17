<?php

namespace App\Http\Requests\Api\V1;

use App\Helpers\GenerateTinyLink;
use Illuminate\Foundation\Http\FormRequest;

class TinyLinkFormRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
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


    /**
     * Get the fields for creating a tiny link record
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'origin_link' => $this->input('link'),
            'tiny_link' => GenerateTinyLink::generate($this->input('link')),
            'expiration_date' => $this->input('expiration_date'),
            'is_active' => true
        ];
    }
}
