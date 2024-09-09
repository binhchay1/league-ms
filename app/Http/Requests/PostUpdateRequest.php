<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' =>'required',
            'content' =>'required',
            'category_id' =>'required',
            'status' =>'required',
            'thumbnail' =>'mimes:jpeg,png,jpg'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('Title is required'),
            'content.required' => __('Content is required'),
            'category_id.required' => __('Category is required'),
            'status.required' => __('Status is required'),
            'thumbnail.mine' => __('Thumbnail is: jpeg,png,jpg '),
        ];
    }
}
