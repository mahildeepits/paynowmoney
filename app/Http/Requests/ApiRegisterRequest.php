<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sponsor' => 'required',
            'sponsor_name' => 'required',
            'full_name' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|integer',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pin_code' => 'nullable|string',
            'nominee_name' => 'nullable|string',
            'card_front' => 'nullable|image',
            'card_back' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'card_front.required' => 'Adhaar Front Image is required',
            'card_back.required' => 'Adhaar Back Image is required',
            'email.email' => 'Please enter valid email address',
            'adhaar_number.unique' => 'This Adhaar number is already registered',
            'mobile.integer' => 'Invalid Mobile Number'
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
