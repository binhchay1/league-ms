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
            'result_team_1.required' => __('validation.required'),
            'result_team_1.min' => __('validation.min'),
            'result_team_1.max' => __('validation.max'),
            'result_team_2.required' => __('validation.required'),
            'result_team_2.min' => __('validation.min'),
            'result_team_2.max' => __('validation.max'),
            'set_1_team_1.required' => __('validation.required'),
            'set_1_team_1.min' => __('validation.min'),
            'set_1_team_2.required' => __('validation.required'),
            'set_1_team_2.min' => __('validation.min'),
            'set_2_team_1.required' => __('validation.required'),
            'set_2_team_1.min' => __('validation.min'),
            'set_2_team_2.required' => __('validation.required'),
            'set_2_team_2.min' => __('validation.min'),
            'set_3_team_1.required' => __('validation.required'),
            'set_3_team_1.min' => __('validation.min'),
            'set_3_team_2.required' => __('validation.required'),
            'set_3_team_2.min' => __('validation.min'),
        ];

    }
}
