<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'images' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description' => ['required', 'max:255'],
            'category' => ['required', 'max:255'],
            'brand' => ['required', 'max:255'],
            'price' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'images.required' => __('Image is required'),
            'images.image' => __('Incorrect image format'),
            'images.mimes' => __('Incorrect image format'),
            'images.max' => __('Image size is maximum'),
            'description.required' => __('Description is required'),
            'description.max' => __('Description must not exceed 255 characters'),
            'category.required' => __('Category is required'),
            'category.max' => __('Category must not exceed 255 characters'),
            'brand.required' => __('Brand is required'),
            'brand.max' => __('Brand must not exceed 255 characters'),
            'price.required' => __('Price is required'),
        ];
    }
}
