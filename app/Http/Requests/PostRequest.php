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
            'images' => ['nullable', 'array', 'max:2048'],
            'images.*' => ['nullable','image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容は必須です。',
            'content.max' => '投稿は140文字以内で入力してください。',
            'image.image' => 'アップロードは画像ファイルのみです。',
            'image.mimes' => '画像形式はjpeg、png、jpg、gifのみです。',
            'image.max' => '画像サイズは2MB以下にしてください。'
        ];
    }
}
