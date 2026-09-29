<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiUpdateKycRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'aadhar_no' => 'nullable|string',
            'aadhar_front' => 'nullable|image',
            'aadhar_back' => 'nullable|image',
            'pan_no' => 'nullable|string',
            'pan_front' => 'nullable|image',
            'pan_back' => 'nullable|image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
