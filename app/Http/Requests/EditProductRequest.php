<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name' => 'required|max:50',
            'category_id' => 'required',
            'origin_price' => 'required|integer|min:0|max:10000000',
            'sale_price' => 'integer|min:0|nullable',
            'status' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:products,id,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'edit_slug.unique' => 'Đường dẫn sản phẩm bị trùng vui vòng thay đổi đường dẫn',
            'slug.unique' => 'Đường dẫn sản phẩm bị trùng vui vòng thay đổi đường dẫn',
            'images.*.size' => 'Vui lòng chọn file dưới 10Mb',
            'images.*.mimes' => 'Vui lòng chọn đúng định dạng ảnh',
            'images.required' => 'Vui lòng tải lên ảnh sản phẩm',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'status.required' => 'Vui lòng chọn trạng thái sản phẩm',
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'integer' => ':attribute phải là số nguyên dương',
        ];
    }
    public function attributes()
    {
        return [
            'slug' => 'Đường dẫn sản phẩm',
            'name' => 'Tên sản phẩm',
            'category_id' => 'Danh mục sản phẩm',
            'origin_price' => "Giá gốc sản phẩm",
            'sale_price' => 'Giá khuyến mãi sản phẩm',
            'status' => 'Trạng thái sản phẩm',
            'content' => 'Mô tả sản phẩm'
        ];
    }
}
