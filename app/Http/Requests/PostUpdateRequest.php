<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'content' => ['required', 'max:140'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // ２MBまで投稿可能
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容は必須です。',
            'content.max' => '投稿は140文字以内で入力してください。',
            'image.mimes' => '画像はjpeg, png, jpg, gif形式でアップロードしてください。',
            'image.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}
