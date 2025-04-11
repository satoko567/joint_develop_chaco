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
        return [
            'content' => ['required', 'max:140'],
            'images' => ['nullable', 'array', 'max:4'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'new_images' => ['nullable', 'array', 'max:4'],
            'new_images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer', 'exists:post_images,id'],
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
            'images.*.max' => '画像サイズは2MB以下にしてください。',
            'new_images.array' => '新しく追加する画像は配列形式で送信してください。',
            'new_images.max' => '画像は最大4枚までアップロード可能です。',
            'new_images.*.image' => 'アップロードは画像ファイルのみです。',
            'new_images.*.mimes' => '画像形式はjpeg、png、jpg、gifのみです。',
            'new_images.*.max' => '画像サイズは2MB以下にしてください。',
            'delete_images.*.integer' => '削除する画像IDが正しくありません。',
            'delete_images.*.exists' => '削除対象の画像が存在しません。',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $postId = $this->route('id');

            $existingCount = $postId ? PostImage::where('post_id', $postId)->count() : 0;
            $deleteCount = is_array($this->delete_images) ? count($this->delete_images) : 0;
            $newCount = is_array($this->new_images) ? count($this->new_images) : 0;

            $finalTotal = $existingCount - $deleteCount + $newCount;

            if ($finalTotal > 4) {
                $validator->errors()->add('new_images', '投稿に添付できる画像は最大4枚までです。');
            }
        });
    }
}
