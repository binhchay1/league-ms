<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:2',
            'email' => 'string|email',
            'age' => 'date_format:Y-m-d|before:today',
            'phone' => 'bail|digits_between:10,11',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.max' => __('validation.max'),
            'email.email' => __('validation.email'),
            'email.string' => __('validation.string'),
            'age.before' => __('validation.before'),
            'age.date_format' => __('validation.before'),
            'phone.before' => __('validation.bail'),
            'phone.digits_between' => __('validation.digits_between'),
            'profile_photo_path.image' => __('validation.image'),
            'profile_photo_path.mimes' => __('validation.mimes'),
            'profile_photo_path.max' => __('validation.max'),
        ];
    }
}
