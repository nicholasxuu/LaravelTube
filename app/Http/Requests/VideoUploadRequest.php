<?php

namespace App\Http\Requests;

class VideoUploadRequest extends Request
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
            'name'     => 'required|max:255',
            'category_id' => 'required',
            'video'    => 'required|max:2048|mimes:mp4,webm',
        ];
    }
}
