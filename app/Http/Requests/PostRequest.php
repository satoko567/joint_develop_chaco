<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'images' => ['nullable', 'array', 'max:4'],
            'images.*' => ['nullable','image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容は必須です。',
            'content.max' => '投稿は140文字以内で入力してください。',
            'images.max' => '画像は最大4枚までアップロード可能です。',
            'images.*.image' => 'アップロードは画像ファイルのみです。',
            'images.*.mimes' => '画像形式はjpeg、png、jpg、gifのみです。',
            'images.*.max' => '画像サイズは2MB以下にしてください。'
        ];
    }
}
