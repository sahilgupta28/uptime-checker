<?php

namespace App\Http\Requests\Website;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Modules\Api\V1\Controllers\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Route;

class SaveRequest extends FormRequest
{
    public function __construct(Request $request)
    {
        $this->request_method = $request->method;
        $this->user_id = $request->id;
        $this->rules = [
            'title' => 'max:30|required|string',
            'user_id' => 'required|numeric|exists:users,id',
            'domain' => 'max:100|required|string',
            'description' => 'required',
            'slack_hook' => 'nullable|string|regex:' . config('constants.SLACK_REG'),
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->request_method == 'PUT') {
            $this->updateValidation();
        }
        return $this->rules;
    }

    private function updateValidation()
    {
        $this->rules['id'] = 'required|numeric|exists:websites,id';
    }

    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()
            ->withInput(request()->input())
            ->withError($validator->errors());
    }
}
