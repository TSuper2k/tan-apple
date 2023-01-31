<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'quantity' => 'required|numeric',
            'feature_image_path' => 'required',
            'category_id' => 'required',
            'contents' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được phép để trống',
            'name.unique' => 'Tên sản phẩm không được phép trùng',
            'name.max' => 'Tên sản phẩm không được phép quá 255 kí tự',
            'price.required' => 'Giá sản phẩm không được phép để trống',
            'quantity.required' => 'Số lượng tồn sản phẩm không được phép để trống',
            'quantity.numeric' => 'Số lượng tồn sản phẩm không được phép để trống',
            'feature_image_path.required' => 'Ảnh không được phép để trống',
            'category_id.required' => 'Danh mục không được phép để trống',
            'contents.required' => 'Nội dung không được phép để trống',
        ];
    }
}
