<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeagueRequest extends FormRequest
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
            'name' => ['required', Rule::unique('league')->ignore($this->id)],
            'images' => 'image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_date_register' => 'date',
            'format_of_league' => 'required',
            'number_of_athletes' => 'required',
            'type_of_league' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'name.unique' => __('Name invalid'),
            'coach.required' => __('Coach is required'),
            'images.required' => __('Image is required'),
            'images.image' => __('Incorrect image format'),
            'images.mimes' => __('Incorrect image format'),
            'images.max' => __('Image size is maximum'),
            'start_date.required' => __('Start date is required'),
            'start_date.date' => __('Incorrect start date format'),
            'end_date.required' => __('End date is required'),
            'end_date.date' => __('Incorrect end date format'),
            'end_date_register.date' => __('Incorrect end date format'),
            'end_date.after_or_equal' => __('The end date must be after the start date'),
            'format_of_league.required' => __('Format is required'),
            'number_of_athletes.required' => __('Number of teams is required'),
            'type_of_league.required' => __('Type is required'),
        ];
    }
}
