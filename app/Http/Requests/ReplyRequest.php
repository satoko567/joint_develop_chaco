<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
            'reply_body' => 'required|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'reply_body' => 'リプライ',
        ];
    }

    public function messages()
    {
        return [
            'reply_body.required' => 'リプライを入力してください。',
            'reply_body.string'   => 'リプライは文字列で入力してください。',
            'reply_body.max'      => 'リプライは、100文字以下にしてください。',
        ];
    }
}