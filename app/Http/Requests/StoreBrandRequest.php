<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brandName'=> 'required|string|max:50',
            'brandImage'=> 'required|string|max:100'
        ];
    }
    
    public function messages(): array
    {
        return [
            'brandName.required' => 'The brand name field is required.',
            'brandName.string' => 'The brand name field must be a string.',
            'brandName.max' => 'The brand name field cannot exceed 50 characters.',
            'brandImage.required' => 'The brand image field is required.',
            'brandImage.string' => 'The brand image field must be a string.',
            'brandImage.max' => 'The brand image field cannot exceed 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'The given data is invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
