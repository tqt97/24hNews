<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
