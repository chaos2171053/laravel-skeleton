<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        // TOTO bug:校验失败 Call to undefined function Overtrue\LaravelLang\str_contains(
        return [
            'email' => 'required|string|email|max:255| unique:users',
            'password' => 'required|string',
            'name' => 'required|string|max:20',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '用户名',
            'password' => '密码',
            'email' => '邮箱地址',
        ];
    }
}
