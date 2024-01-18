<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
            'name' => ['required', Rule::unique('groups')->ignore($this->name)],
            'images' => ['image', 'mimes:jpeg,png,jpg'],
            'description' => ['required', 'max:255'],
            'activity_time_start' => ['required'],
            'activity_time_end' => ['after_or_equal:activity_time_start'],
            'number_of_members' => ['required'],
            'location' => ['required', 'string', 'max:255'],
            'note' => ['string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'name.unique' => __('Name invalid'),
            'description.required' => __('Description is required'),
            'description.max' => __('Description must not exceed 255 characters'),
            'images.required' => __('Image is required'),
            'images.image' => __('Incorrect image format'),
            'images.mimes' => __('Incorrect image format'),
            'activity_time_start.required' => __('Activity time start is required'),
            'activity_time_end.after_or_equal' => __('Activity time end must be after or equal to activity time start'),
            'number_of_members.required' => __('Number of members is required'),
            'number_of_members.number' => __('Incorrect number of members format'),
            'location.required' => __('Location is required'),
            'location.string' => __('Incorrect location format'),
            'location.max' => __('Location must not exceed 255 characters'),
            'note.required' => __('Type is required'),
            'note.required' => __('Type is required'),
        ];
    }
}
