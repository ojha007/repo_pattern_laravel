<?php


namespace App\Http\Controllers\Request;


use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ApiFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            throw new ApiValidationException('The given data was invalid.', $validator->errors(), 422);
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}
