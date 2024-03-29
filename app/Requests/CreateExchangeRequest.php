<?php

namespace App\Requests;

use App\Models\Exchange;
use App\Base\BaseRequest;
use Illuminate\Validation\Rule;

class CreateExchangeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'type' => [
                'required',
                'string',
                Rule::in(Exchange::getAvailableTypes()),
            ],
            'api_key' => [
                'required',
                'string',
                'max:255',
            ],
            'api_secret' => [
                'required',
                'string',
                'max:255',
            ],
            'hedge' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
