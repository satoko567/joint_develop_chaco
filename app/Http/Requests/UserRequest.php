<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は、必ず指定してください。',
            'name.max' => ':attributeは:max文字以下で入力して下さい。',
            'email.required' => 'メールアドレスは、必ず指定してください。',
            'email.email' => 'メールアドレスは、有効なメールアドレス形式で指定してください。',
            'email.unique:users' => '指定のメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは、必ず指定してください。',
            'password.min:8' => 'パスワードは、8文字以上にしてください。',
            'password.confirmed' => 'パスワードとパスワード確認が一致しません。',
        ];
    }
}
