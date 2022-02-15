<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject' => 'required',
            'message' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường không được để trống',
            'email.required' => 'Trường không được để trống',
            'phone.required' => 'Trường không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'subject.required' => 'Trường không được để trống',
            'message.required' => 'Trường không được để trống',
        ];
    }
}
