<?php

namespace App\Http\Requests\Website;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Modules\Api\V1\Controllers\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Route;

class saveRequest extends FormRequest
{
    public function __construct(Request $request)
    {
        $this->request_method = $request->method;
        $this->user_id = $request->id;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:30|required|string',
            'user_id' => 'required|Numeric|exists:users,id',
            'domain' => 'max:100|required|string',
            'description' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()
            ->withInput(request()->input())
            ->withError($validator->errors());
    }
}
