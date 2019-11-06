<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|min:0',
            'slug' => 'required|unique:categories,id,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'slug' => 'Đường dẫn sản phẩm bị trùng vui vòng thay đổi đường dẫn',
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
        ];
    }
    public function attributes()
    {
        return [
            'slug' => 'Đường dẫn danh mục',
            'name' => 'Tên danh mục',
        ];
    }
}
