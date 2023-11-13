<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:64',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Tên không được để trống'),
            'name.max' => __('Tên không được vượt quá 255 kí tự'),
            'email.required' => __('Hòm thư không được để trống'),
            'email.email' => __('Hòm thư không đúng định dạng'),
            'email.max' => __('Hòm thư không được vượt quá 255 kí tự'),
            'email.unique' => __('Hòm thư đã tồn tại'),
            'password.required' => __('Mật khẩu không được để trống'),
            'password.string' => __('Mật khẩu không đúng định dạng'),
            'password.min' => __('Mật khẩu tối thiểu trên 8 kí tự'),
            'password.max' => __('Mật khẩu không vượt quá 64 kí tự'),
        ];

    }
}
