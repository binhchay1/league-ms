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
            'name' => ['required', Rule::unique('groups')->ignore($this->id)],
            'images' => ['required','image', 'mimes:jpeg,png,jpg'],
            'description' => ['required', 'max:255'],
            'number_of_members' => ['required','min:0'],
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
            'images.image' => __('Images is required'),
            'images.mimes' => __('Incorrect image format'),
            'number_of_members.required' => __('Number of members is required'),
            'number_of_members.number' => __('Incorrect number of members format'),
            'number_of_members.min' => __('Number of members must not less 1 characters'),
            'location.required' => __('Location is required'),
            'location.string' => __('Incorrect location format'),
            'location.max' => __('Location must not exceed 255 characters'),
            'note.required' => __('Type is required'),
        ];
    }
}
