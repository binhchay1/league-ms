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
            'tournament_id' => 'required',
            'team_id_1' => 'required',
            'team_id_2' => 'required',
            'match' => 'required',
            'time' => 'required',
            'date' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'tournament_id.required' => __('validation.required'),
            'team_id_1.required' => __('validation.required'),
            'team_id_2.required' => __('validation.required'),
            'name.required' => __('validation.required'),
            'match.required' => __('validation.required'),
            'time.required' => __('validation.required'),
            'date.required' => __('validation.required'),

        ];
    }
}
