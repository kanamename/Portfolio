<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
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
            'current-password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if(!(\Hash::check($value, \Auth::user()->password))) {
                    return $fail('現在のパスワードを正しく入力してください');
                    }
                },
            ],
            'new-password' => 'required|string|min:6|confirmed|different:current-password',
            ];
        }
    }
}
