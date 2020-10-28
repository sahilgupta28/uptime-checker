<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Update extends FormRequest
{
    public function __construct(Request $request)
    {
        $request->request->add(['id' => $request->route('user_id')]);
    }

    public function authorize()
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => 'required|string',
            'bio' => 'sometimes',
            'id' => 'required|exists:users,id',
            'email' => 'sometimes|unique:users,email'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return redirect()
            ->back()
            ->withInput(request()->input())
            ->withError($validator->errors());
    }
}
