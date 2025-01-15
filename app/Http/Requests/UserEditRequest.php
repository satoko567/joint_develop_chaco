<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //false to true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required|string|max:25|unique:users,nickname,' . auth()->id(),
            'email' => 'required|string|max:30|email|unique:users,email' . auth()->id(),
            'password' => 'nullable|string|min:8|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])[A-Za-z\d@$!%*?&]+$/',
        ];
    }

    public function attribute()
    {
        return [
            'nickname' => 'ニックネーム',
            'email' => 'Eメールアドレス',
            'password' => 'パスワード'
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'ニックネームは必須です。',
            'nickname.max' => 'ニックネームは25文字以内で入力してください。',
            'email.required' => 'Eメールアドレスは必須です。',
            'email.email' => '有効なEメールアドレスを入力してください。',
            'email.unique' => 'そのEメールアドレスはすでに登録されています。',
            'password.regex' => 'パスワードは大文字、小文字、数字を含む必要があります。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
    
}
