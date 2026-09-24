<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiUpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Original code didn't have strict validation for profile update, 
            // but we can ensure fields are string/date where applicable.
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
            'dob' => 'nullable|date',
            'father_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'pin_code' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'nominee_name' => 'nullable|string',
            'nominee_relation' => 'nullable|string',
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
