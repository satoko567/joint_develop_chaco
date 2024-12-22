<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PictureRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 画像の横幅を取得
        list($width) = getimagesize($value);

        if ($width > 800) {
            return false; // 横幅が800pxより大きければ、バリデーションエラーを返す
        } else {
            return true; // 横幅が800以下だったら処理が実行される
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '横幅が800px以下の画像を選択してください。';
    }
}
