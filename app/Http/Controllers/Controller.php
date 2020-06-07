<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $errors;

    private $message;

    private $http_code;

    public function createJsonResponse($result, $message = '')
    {
        return [
            'data' => $result,
            'message' => $message,
        ];
    }

    public function showBadRequestError($validation_error, $error_message, $http_error_code = 400)
    {
        if ($http_error_code == 400 && !empty($validation_error)) {
            $errors = is_object($validation_error) ? json_decode($validation_error, true) : $validation_error;
            $error_msg = [];
            foreach ($errors as $error) {
                $error_msg[] = is_array($error) ? implode(',', array_values($error)) : $error;
            }

            $error_message = implode(',', array_values($error_msg));
        }
        throw new ApiException($validation_error, $error_message, $http_error_code);
    }

    public function showSuccessRequest($data_set, $message, $http_code)
    {
        $response_data = $this->createJsonResponse($data_set, $message);
        return new JsonResponse($response_data, $http_code);
    }

    public function showBadRequest()
    {
        $response_data = $this->createJsonResponse($this->errors, $this->message);
        return new JsonResponse($response_data, $this->http_code);
    }

    public function updateValidationErrors($errors)
    {
        $this->errors = $errors;
        $this->message = trans('messages.error.validation');
        $this->http_code = 400;
    }

    public function setUnprocessableEntity($error)
    {
        $this->errors = $error;
        $this->message = trans('messages.error.unprocessable_entity');
        $this->http_code = 422;
    }

    public function setNotFound($error)
    {
        $this->errors = $error;
        $this->message = trans('messages.error.not_found');
        $this->http_code = 404;
    }

    public function setForbidden($error)
    {
        $this->errors = $error;
        $this->message = trans('messages.error.forbidden');
        $this->http_code = 403;
    }

    protected function arrayMergeRecursiveDistinct(array &$response, array &$skelton)
    {
        $merged = $response;
        foreach ($skelton as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->arrayMergeRecursiveDistinct($merged[$key], $value);
            } else {
                if (!isset($merged[$key])) {
                    $merged[$key] = $value;
                }
            }
        }
        return $merged;
    }

    public static function removeExtraInputs($inputs, $required_inputs)
    {
        foreach (array_keys($inputs) as $input_key) {
            if (!in_array($input_key, $required_inputs)) {
                unset($inputs[$input_key]);
                continue;
            }
            if (is_array($inputs[$input_key])) {
                $inputs[$input_key] = json_encode($inputs[$input_key]);
            }
        }
        return $inputs;
    }
}
