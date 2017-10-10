<?php

namespace App\Http\Requests;

class UserUpdateRequest extends Request
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
            'name' => 'max:255',
            'email' => '',
            'password' => 'min:6',
            'avatar' => 'mimes:jpeg,png,jpg|max:2048',
            'level' => 'min:0|max:255',
        ];
    }
}
