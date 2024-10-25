<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attributeを入力してください',
            'email.required' => ':attributeを入力してください',
            'password.required' => ':attributeを入力してください',
            'email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'max' => ':attributeは:max文字以内で入力してください。',
            'unique' => 'この:attributeは既に登録されています。',
        ];
    }
}
