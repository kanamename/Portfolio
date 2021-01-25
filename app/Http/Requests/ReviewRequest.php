<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'review' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:350',
        ];
    }

    public function messages(){
        return [
            'review.required'  => '評価を選択してください。',
            'review.integer' => '評価を選択してください。',
            'review.between' => '評価を選択してください。',
            'comment.required'=> 'コメントを入力してください。',
            'comment.max'     => 'コメントは350文字以内で入力してください。',
        ];
    }
}
