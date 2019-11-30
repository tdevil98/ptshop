<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuantityProductRequest extends FormRequest
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
            'size' => 'required|integer|unique:product_quantity,size,product_id',
            'quantity' => 'required|integer'
        ];
    }
    public function messages()
    {
        return[
            'required' => ':attribute không được để trống',
            'integer' => ':attribute phải là số nguyên dương',
            'unique' => ':attribute đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'size' => 'Kích cỡ sản phẩm',
            'quantity' => 'Số lượng'
        ];
    }
}
