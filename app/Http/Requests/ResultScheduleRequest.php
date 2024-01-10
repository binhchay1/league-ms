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
            'set_1_team_1' => 'min:0|max:30',
            'set_1_team_2' => 'min:0|max:30',
            'set_2_team_1' => 'min:0|max:30',
            'set_2_team_2' => 'min:0|max:30',
            'set_3_team_1' => 'min:0|max:30',
            'set_3_team_2' => 'min:0|max:30',
        ];
    }

    public function messages()
    {
        return [
            'result_team_1.required' => __('Team 1 score cannot be left blank'),
            'result_team_1.min' => __('Minimum score of 1st team is over 1'),
            'result_team_2.min' => __('Team 2 score must be at least 1'),
            'result_team_2.max' => __('Team 2 score cannot exceed 2'),
            'set_1_team_1.min' => __('The minimum score of match 1 is 0'),
            'set_1_team_1.max' => __('Team 1 score cannot exceed 2'),
            'set_1_team_2.min' => __('The minimum score of match 2 is 0'),
            'set_1_team_2.max' => __('Team 2 score cannot exceed 2'),
            'set_2_team_1.min' => __('The minimum score of match 2 is 0'),
            'set_2_team_1.max' => __('Team 1 score cannot exceed 2'),
            'set_2_team_2.min' => __('The minimum score of match 2 is 0'),
            'set_2_team_2.max' => __('Team 2 score cannot exceed 2'),
            'set_3_team_1.min' => __('The minimum score of match 3 is 0'),
            'set_3_team_1.max' => __('Team 1 score cannot exceed 2'),
            'set_3_team_2.min' => __('The minimum score of match 4 is 0'),
            'set_3_team_2.max' => __('Team 1 score cannot exceed 2'),
        ];
    }
}
