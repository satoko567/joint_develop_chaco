<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は、必ず指定してください。',
            'name.string' => '名前は、文字列で入力してください。',
            'name.max' => '名前は、20文字以内で入力してください。',
            'email.required' => 'メールアドレスは、必ず指定してください。',
            'email.email' => 'メールアドレスは、有効なメールアドレス形式で指定してください。',
            'email.unique' => 'このメールアドレスは、既に使用されています。',
            'password.required' => 'パスワードは、必ず指定してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
