<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultScheduleRequest extends FormRequest
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
            'result_team_1' => 'required|min:1|max:2',
            'result_team_2' => 'required|min:1|max:2',
            'set_1_team_1' => 'required|min:0',
            'set_1_team_2' => 'required|min:0',
            'set_2_team_1' => 'required|min:0',
            'set_2_team_2' => 'required|min:0',
            'set_3_team_1' => 'required|min:0',
            'set_3_team_2' => 'required|min:0',
        ];
    }

    public function messages()
    {
        return [
            'result_team_1.required' => __('Tỉ số đội 1 không được để trống'),
            'result_team_1.min' => __('Tỉ số đội 1 tối thiểu trên 1 '),
            'result_team_1.max' => __('Tỉ số đội 1 không vượt quá 2 '),
            'result_team_2.required' => __('Tỉ số đội 2 không được để trống'),
            'result_team_2.min' => __('Tỉ số đội 2 tối thiểu trên 1 '),
            'result_team_2.max' => __('Tỉ số đội 2 không vượt quá 2 '),
            'set_1_team_1.required' => __('Tỉ số trận 1 không được để trống'),
            'set_1_team_1.min' => __('Tỉ số trận 1 tối thiểu là 0'),
            'set_1_team_2.required' => __('Tỉ số trân 1 không được để trống'),
            'set_1_team_2.min' => __('Tỉ số trận 1 tối thiểu là 0'),
            'set_2_team_1.required' => __('Tỉ số trân 2 không được để trống'),
            'set_2_team_1.min' => __('Tỉ số trận 2 tối thiểu là 0'),
            'set_2_team_2.required' => __('Tỉ số trân 2 không được để trống'),
            'set_2_team_2.min' => __('Tỉ số trận 2 tối thiểu là 0'),
            'set_3_team_1.required' => __('Tỉ số trân 3 không được để trống'),
            'set_3_team_1.min' => __('Tỉ số trận 3 tối thiểu là 0'),
            'set_3_team_2.required' => __('Tỉ số trân 3 không được để trống'),
            'set_3_team_2.min' => __('Tỉ số trận 4 tối thiểu là 0'),
        ];

    }
}
