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
            'title' =>  ['required', 'string'],
            'image' =>  ['required', 'mimes:jpg,bmp,png,jpeg,gif,webp,svg', 'dimensions:max-width=1500,max_height=1500'],
            'content' =>  'required',
            'category_id' =>  'required',
            'description' =>  'required',
            'is_highlight' =>  ['required', 'boolean'],
            'status' =>  ['required', 'boolean'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tên bài viết không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'description.required' => 'Mô tả ngắn không được để trống',
            'category_id.required' => 'Tên danh mục không được để trống',
        ];
    }
}
