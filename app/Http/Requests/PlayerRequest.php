<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'team_id' => 'required|unique:players',
            'name'=> 'required',
            'birthday' =>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'team_id.required' => __('validation.required'),
            'team_id.unique' => __('validation.unique'),
            'name.required' => __('validation.required'),
            'birthday.required' => __('validation.required'),
            'birthday.image' => __('validation.date'),
        ];
    }
}
