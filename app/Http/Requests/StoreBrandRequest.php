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
            'brandName'=> 'required|max:50',
            'brandImage'=> 'required|max:100'
        ];
    }
    
    public function messages(): array
    {
        return [
            'brandName.required' => 'The brand name is required.',
            'brandName.max' => 'The brand name cannot exceed 50 characters.',
            'brandImage.required' => 'The brand image is required.',
            'brandImage.max' => 'The brand image cannot exceed 100 characters.',
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
