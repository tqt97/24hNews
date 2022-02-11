<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' =>  ['required', 'string',Rule::unique('posts')->ignore($this->post->id)],
            'content' =>  'required',
            'description' =>  'required',
            'is_highlight' =>  ['required', 'boolean'],
            'status' =>  ['required', 'boolean'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tên bài viết không được để trống',
            'title.unique' => 'Tên đã tồn tại',
            'content.required' => 'Nội dung không được để trống',
            'description.required' => 'Mô tả ngắn không được để trống',
        ];
    }
}
