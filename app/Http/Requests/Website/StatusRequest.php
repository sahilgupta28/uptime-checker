<?php

namespace App\Http\Requests\Website;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Modules\Api\V1\Controllers\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Route;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'is_active' => 'required|boolean'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()
            ->withInput(request()->input())
            ->withError($validator->errors());
    }
}
