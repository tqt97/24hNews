<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'email' => ['required', Rule::unique('admins')->ignore($this->admin->id)],
            'address' =>  'string',
            'phone' =>  'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email không được trùng',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirm.same' => 'Mật khẩu xác nhận không khớp',
        ];
    }
}
