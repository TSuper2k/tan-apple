<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|unique:customers|email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.max' => 'Tên không được phép quá 255 kí tự',
            'email.required' => 'Email không được phép để trống',
            'email.unique' => 'Email không được phép trùng',
            'phone.required' => 'Số điện thoại không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'password.required' => 'Mật khẩu không được phép để trống',
            'password_confirmation.required' => 'Mật khẩu không được phép để trống',
            'password_confirmation.same' => 'Mật khẩu không khớp',
        ];
    }
}
