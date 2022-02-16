<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'url' => 'string',
            'description' => 'string',
            'order' => 'numeric',
            'status' => 'boolean',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Trường không được để trống !',
        ];
    }
}
