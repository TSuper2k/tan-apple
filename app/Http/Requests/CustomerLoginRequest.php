<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
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
            'email_account' => 'required|email',
            'password_account' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email_account.required' => 'Email không được phép để trống',
            'email_account.email' => 'Email bị sai định dạng',
            'password_account.required' => 'Mật khẩu không được phép để trống',
        ];
    }
}
