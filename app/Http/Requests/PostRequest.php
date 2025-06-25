<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Tag;

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
            'shop_name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'content' => 'required|max:1000',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'shop_name' => '整備工場名',
            'address' => '住所',
            'content' => '投稿',
            'image' => '画像',
            'tags' => 'タグ',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => '画像ファイル（JPG・PNGなど）以外はアップロードできません。',
            'image.max' => '画像は2MB以下のファイルを選択してください。',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('tags')) {
            $normalizedTags = str_replace('，', ',', $this->input('tags'));
            $normalizedTags = preg_replace('/\s*,\s*/', ',', $normalizedTags);
            $this->merge([
                'tags' => trim($normalizedTags),
            ]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tagNames = Tag::parseTagNames($this->input('tags'));
            if (count($tagNames) > 10) {
                $validator->errors()->add('tags', 'タグは最大10個までです。');
            }
            foreach ($tagNames as $tag) {
                if (mb_strlen($tag) > 20) {
                    $validator->errors()->add('tags', '1つのタグは20文字以内で入力してください。');
                    break;
                }
            }
        });
    }
}