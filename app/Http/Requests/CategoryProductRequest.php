<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('post_categories')->ignore($this->id)],
            'image' => ['required','image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'name.unique' => __('Name invalid'),
            'images.required' => __('Image is required'),
            'images.image' => __('Incorrect image format'),
            'images.mimes' => __('Incorrect image format'),
            'images.max' => __('Image size is maximum'),

        ];
    }
}
