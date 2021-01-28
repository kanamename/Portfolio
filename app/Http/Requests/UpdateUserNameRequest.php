<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserNameRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:15'],
            ];
        }
    }
}
