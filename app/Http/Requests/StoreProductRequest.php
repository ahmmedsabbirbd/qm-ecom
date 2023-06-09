<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title'=> 'required',
            'short_des'=> 'required',
            'price'=> 'required',
            'discount'=> 'required',
            'discount_price'=> 'required',
            'image'=> 'required',
            'stock'=> 'required',
            'star'=> 'required',
            'remark'=> 'required',
            'category_id'=> 'required',
            'brand_id'=> 'required'
        ];
    }
}
