<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingEditRequest extends FormRequest
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
            'config_key' => 'required|max:255',
            'config_value' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'config_key.required' => 'Config key không được phép để trống',
            'config_key.max' => 'Config key không được phép quá 255 kí tự',
            'config_value.required' => 'Config value không được phép để trống',
            'config_value.max' => 'Config value không được phép quá 255 kí tự',
        ];
    }
}
