<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|max:255|email',
            'password' => 'required|string|min:8|max:64',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('Email is required'),
            'email.email' => __('Incorrect email format'),
            'email.max' => __('Email must not exceed 255 characters'),
            'password.required' => __('Password is required'),
            'password.string' => __('Incorrect password format'),
            'password.min' => __('Password must be at least 8 characters'),
            'password.max' => __('Password must not exceed 64 characters'),
        ];
    }
}
