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
            'team_id' => 'required',
            'name'=> 'required',
            'birthday' =>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'team_id.required' => __('validation.required'),
            'name.required' => __('validation.required'),
            'birthday.required' => __('validation.required'),
            'birthday.date' => __('validation.date'),
        ];
    }
}
