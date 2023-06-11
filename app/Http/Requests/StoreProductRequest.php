<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'title'=> 'required|string|max:100',
            'short_des'=> 'required|string',
            'price'=> 'required|string',
            'discount'=> 'required|boolean',
            'discount_price'=> 'required|string|max:10',
            'image'=> 'required|string|max:100',
            'stock'=> 'required|boolean',
            'star'=> 'required|numeric',
            'remark'=> [
                'required',
                Rule::in(['hot', 'normal', 'best-selling']),
            ],
            'category_id'=> [
                'required',
                'integer',
                Rule::exists('categories', 'id')
            ],
            'brand_id'=> [
                'required',
                'integer',
                Rule::exists('brands', 'id')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field cannot exceed 100 characters.',
            'short_des.required' => 'The short description field is required.',
            'short_des.string' => 'The short description field must be a string.',
            'price.required' => 'The price field is required.',
            'price.string' => 'The price field must be a string.',
            'discount.required' => 'The discount field is required.',
            'discount.boolean' => 'The discount field must be a boolean value.',
            'discount_price.required' => 'The discount price field is required.',
            'discount_price.string' => 'The discount price field must be a string.',
            'discount_price.max' => 'The discount price field cannot exceed 10 characters.',
            'image.required' => 'The image field is required.',
            'image.string' => 'The image field must be a string.',
            'image.max' => 'The image field cannot exceed 100 characters.',
            'stock.required' => 'The stock field is required.',
            'stock.boolean' => 'The stock field must be a boolean value.',
            'star.required' => 'The star field is required.',
            'star.numeric' => 'The star field must be a numeric value.',
            'remark.required' => 'The remark field is required.',
            'remark.in' => 'The selected remark is invalid.',
            'category_id.required' => 'The category ID field is required.',
            'category_id.integer' => 'The category ID field must be an integer.',
            'category_id.exists' => 'The selected category ID is invalid.',
            'brand_id.required' => 'The brand ID field is required.',
            'brand_id.integer' => 'The brand ID field must be an integer.',
            'brand_id.exists' => 'The selected brand ID is invalid.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response()->json([
            'success' => false,
            'message' => 'The given data is invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
