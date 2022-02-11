<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateRoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->role->id)],
            'display_name' =>['required','string'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên quyền không được để trống',
            'name.unique' => 'Tên đã tồn tại',
            'display_name.required' => 'Mô tả không được để trống',
        ];
    }
}
