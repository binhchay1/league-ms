<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SportRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => ['required', Rule::unique('teams')->ignore($this->id)],
            'link' =>'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => __('Tên không được để trống'),
            'link.required' => __('Địa chỉ liên kết không được để trống'),
            'name.unique' => __('Tên không được trùng nhau'),
            'coach.required' => __('Huấn luyện viên không được bỏ trống'),
            'image.required' => __('Hình ảnh không được bỏ trống'),
            'image.image' => __('Hình ảnh phải là dạng ảnh'),
            'image.mimes' => __('Hình ảnh không đúng định dạng'),
            'image.max' => __('Kích thước ảnh vượt quá 2048px'),
        ];
    }
}
