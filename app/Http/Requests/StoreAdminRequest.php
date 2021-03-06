<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'email' => 'required|unique:admins,email',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
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
