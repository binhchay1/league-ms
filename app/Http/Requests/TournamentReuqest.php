<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TournamentReuqest extends FormRequest
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
            'name.unique' => __('validation.unique'),
            'start_date.required' => __('validation.required'),
            'start_date.date' => __('validation.date'),
            'end_date.required' => __('validation.required'),
            'end_date.date' => __('validation.date'),
            'end_date.after_or_equal' => __('validation.after_or_equal'),
            'format.required' => __('validation.required'),
            'number_of_team.required' => __('validation.required'),
            'type.required' => __('validation.required'),
            'image.image' => __('validation.image'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max'),
        ];
    }
}
