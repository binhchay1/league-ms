<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => ['required', Rule::unique('teams')->ignore($this->id)],
            'coach' =>'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'coach.required' => __('validation.required'),
            'image.required' => __('validation.required'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max'),
        ];
    }
}
