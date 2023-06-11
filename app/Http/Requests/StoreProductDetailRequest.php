<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreProductDetailRequest extends FormRequest
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
            'img1'=> 'required|string|max:100',
            'img2'=> 'required|string|max:100',
            'img3'=> 'required|string|max:100',
            'img4'=> 'required|string|max:100',
            'des'=> 'required|string',
            'color'=> 'required|string|max:100',
            'size'=> 'required|string|max:100',
            'product_id'=> [
                'required',
                'integer',
                Rule::unique('product_details', 'product_id')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'img1.required'=>'The image 1 field is required',
            'img1.string'=>'The image 1 field must be a string.',
            'img1.max' => 'The image 1 field cannot exceed 100 characters.',
            'img2.required' => 'The image 2 field is required.',
            'img2.string' => 'The image 2 field must be a string.',
            'img2.max' => 'The image 2 field cannot exceed 100 characters.',
            'img3.required' => 'The image 3 field is required.',
            'img3.string' => 'The image 3 field must be a string.',
            'img3.max' => 'The image 3 field cannot exceed 100 characters.',
            'img4.required' => 'The image 4 field is required.',
            'img4.string' => 'The image 4 field must be a string.',
            'img4.max' => 'The image 4 field cannot exceed 100 characters.',
            'des.required' => 'The description field is required.',
            'des.string' => 'The description field must be a string.',
            'color.required' => 'The color field is required.',
            'color.string' => 'The color field must be a string.',
            'color.max' => 'The color field cannot exceed 100 characters.',
            'size.required' => 'The size field is required.',
            'size.string' => 'The size field must be a string.',
            'size.max' => 'The size field cannot exceed 100 characters.',
            'product_id.required' => 'The product ID field is required.',
            'product_id.integer' => 'The product ID field must be an integer.',
            'product_id.unique' => 'The selected product ID is already taken.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response()->json([
            'success' => false,
            'message' => 'The given data is invalid.',
            'errors' => $validator->errors(),
        ]));
    }
}
