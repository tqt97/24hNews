<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'image' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tên bài viết không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Tên danh mục không được để trống',
        ];
    }
}
