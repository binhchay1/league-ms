<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentReuqest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date'=> 'required',
            'end_date' =>'required',
            'format' =>'required',
            'number_of_team' =>'required',
            'people_of_team' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => __('validation.required'),
            'end_date.required' => __('validation.required'),
            'format.required' => __('validation.required'),
            'number_of_team.required' => __('validation.required'),
            'people_of_team.required' => __('validation.required'),
        ];
    }
}
