<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'location' => ['required'],
            'description' => ['required', 'max:255'],
            'number_of_members' => ['required', 'min:0'],
            'end_time' => ['required'],
            'start_time' => ['required'],
            'date' => ['required'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'description.required' => __('Description is required'),
            'description.max' => __('Description must not exceed 255 characters'),
            'number_of_members.required' => __('Number of members is required'),
            'number_of_members.number' => __('Incorrect number of members format'),
            'number_of_members.min' => __('Number of members must not less 1 characters'),
            'location.required' => __('Location is required'),
            'location.string' => __('Incorrect location format'),
            'location.max' => __('Location must not exceed 255 characters'),
            'start_time.required' => __('Activity time start is required'),
            'end_time.required' => __('Activity time end is required'),
            'date.required' => __('Activity date is required'),
        ];
    }
}
