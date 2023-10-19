<?php

namespace App\Http\Requests;

class StoreMessageFormRequest extends StoreMessageRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            (new StoreMessageAuthorRequest())->rules(),
            ['tag' => 'array']
        );
    }
}
