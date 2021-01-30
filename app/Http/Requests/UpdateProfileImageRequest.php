<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileImageRequest extends FormRequest
{
    // ゲストユーザIDを定義
    private const GUEST_USER_ID = 1;
    
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
        // ゲストユーザーログイン時は、バリデーションにかけない
        if(Auth::id() !== self::GUEST_USER_ID) {
            return [
                'image' => [
                    // 必須
                    'required',
                    // アップロードされたファイルであること
                    'file',
                    // MIMEタイプを指定
                    'mimes:jpeg,jpg,png,bmp,gif,svg',
                ]
            ];
        }
    }

    public function messages(){
        return [
            'image.required'  => 'プロフィール画像を選択してください。',
            'image.file' => 'プロフィール画像を選択してください。',
            'image.mimes' => '画像ファイルを選択してください。',
        ];
    }
}
