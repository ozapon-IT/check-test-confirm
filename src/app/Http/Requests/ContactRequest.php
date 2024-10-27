<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|max:255',
            'phone1' => 'required|numeric|digits_between:1,5',
            'phone2' => 'required|numeric|digits_between:1,5',
            'phone3' => 'required|numeric|digits_between:1,5',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'content' => 'required',
            'detail' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓を255文字以下で入力してください',
            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名を255文字以下で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'phone1.required' => '電話番号(1)を入力してください',
            'phone1.numeric' => '電話番号(1)を数値で入力してください',
            'phone1.digits_between' => '電話番号(1)は5桁までの数字で入力してください',
            'phone2.required' => '電話番号(2)を入力してください',
            'phone2.numeric' => '電話番号(2)を数値で入力してください',
            'phone2.digits_between' => '電話番号(2)は5桁までの数字で入力してください',
            'phone3.required' => '電話番号(3)を入力してください',
            'phone3.numeric' => '電話番号(3)を数値で入力してください',
            'phone3.digits_between' => '電話番号(3)は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '住所を文字列で入力してください',
            'address.max' => '住所を255文字以下で入力してください',
            'building.string' => '建物名を文字列で入力してください',
            'building.max' => '建物名を255文字以下で入力してください',
            'content.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容を文字列で入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以下で入力してください',
        ];
    }
}
