<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    /**
     * バリデーションエラーメッセージ
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // メッセージは後で設定
    }

    /**
     * バリデーションルールを適用
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 数字のみで、2〜5桁かどうかをチェック
        if (preg_match('/^\d{1,5}$/', $value)) {
            return true;
        }

        // バリデーションに失敗した場合のメッセージを設定
        $this->message = ':attributeは5桁までの数字で入力してください。';

        return false;
    }

    /**
     * バリデーションエラーメッセージを取得
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
