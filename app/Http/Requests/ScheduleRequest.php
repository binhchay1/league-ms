<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'league_id' => 'required',
            'round' => 'required',
            'time' => 'required',
            'date' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'league_id.required' => __('Giải đấu không được để trống'),
            'name.required' => __('Tên không được để trống'),
            'round.required' => __('Vòng đấu không được để trống'),
            'time.required' => __('Thời gian thi đấu không được để trống'),
            'date.required' => __('Ngày thi đấu không được bỏ trống'),
        ];
    }
}
