<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\PostImage;

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
        $isUpdate = $this->routeIs('posts.update');

        return [
            'content' => ['required', 'max:140'],
            'image' => array_merge(
                $isUpdate ? ['nullable'] : ['required'],
                ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ),
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容は必須です。',
            'content.max' => '投稿は140文字以内で入力してください。',
            'image.required' => '画像投稿は必須です。',
            'image.mimes' => '画像はjpeg, png, jpg, gif形式でアップロードしてください。',
            'image.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}
