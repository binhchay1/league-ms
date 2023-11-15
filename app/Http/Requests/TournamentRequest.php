<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TournamentRequest extends FormRequest
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
            'name' => ['required', Rule::unique('tournaments')->ignore($this->id)],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'start_date'=> 'required|date',
            'end_date' =>'required|date|after_or_equal:start_date',
            'format' =>'required',
            'number_of_team' =>'required',
            'type' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Tên không được để trống'),
            'name.unique' => __('Tên không được trùng nhau'),
            'coach.required' => __('Huấn luyện viên không được bỏ trống'),
            'image.required' => __('Hình ảnh không được bỏ trống'),
            'image.image' => __('Hình ảnh phải là dạng ảnh'),
            'image.mimes' => __('Hình ảnh không đúng định dạng'),
            'image.max' => __('Kích thước ảnh vượt quá 2048px'),
            'start_date.required' => __('Ngày bắt đầu không được để trống'),
            'start_date.date' => __('Ngày bắt đầu không đúng định dạng'),
            'end_date.required' => __('Ngày kết thúc không được để trống'),
            'end_date.date' => __('Ngày kết thúc không đúng định dạng'),
            'end_date.after_or_equal' => __('Ngày kết thúc phải sau ngày bắt đầu'),
            'format.required' => __('Hình thức thi đấu không được để trống'),
            'number_of_team.required' => __('Số đội tham gia không được để trống'),
            'type.required' => __('Thể thức thi đấu không được để trống'),
        ];
    }
}
