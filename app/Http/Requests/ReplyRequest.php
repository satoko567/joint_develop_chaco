<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'リプライは必須です。',
            'content.max' => 'リプライは、255文字以下にしてください。',
        ];
    }
}
