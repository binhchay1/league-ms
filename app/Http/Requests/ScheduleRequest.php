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
            'league_id.*' => ['required'],
            'round.*' =>['required'],
            'match.*' => 'required|numeric',
            'time.*' => 'required',
            'date.*' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'league_id.*.required' =>__('validation.required'),
            'round.*.required' => __('validation.required'),
            'match.*.required' =>__('validation.required'),
            'match.*.numeric' =>__('validation.numeric'),
            'time.*.required' => __('validation.required'),
            'date.*.required' => __('validation.required'),
        ];
    }
}
