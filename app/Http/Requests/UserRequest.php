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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'. $this->id],
            'profile' => ['nullable', 'string', 'max:140'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png']
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'パスワードが一致しません',
            'avatar.image' => '画像ファイルを選択してください。'
        ];
    }
}
