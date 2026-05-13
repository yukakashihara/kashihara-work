<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'last_name'  => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name_kana'   => 'required|max:50|regex:/^[ァ-ヶー]+$/u',
            'first_name_kana'  => 'required|max:50|regex:/^[ァ-ヶー]+$/u',
            'email'            => 'required|max:255|email|unique:users,email',
            'password'         => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required|min:8|max:20',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'last_name.max' => '姓は50文字以内で入力してください',
            'first_name.max' => '名は50文字以内で入力してください',
            'last_name_kana.required' => '姓（カナ）を入力してください',
            'first_name_kana.required' => '名（カナ）を入力してください',
            'last_name_kana.max' => '姓は50文字以内で入力してください',
            'first_name_kana.max' => '名は50文字以内で入力してください',
            'last_name_kana.regex' => 'カタカナで入力してください',
            'first_name_kana.regex' => 'カタカナで入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => '正しいメールアドレスを入力してください',
            'email.max'      => 'メールアドレスは255文字以内で入力してください',
            'email.unique' => 'このメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min'      => 'パスワードは8文字以上20文字以内で入力してください',
            'password.max'      => 'パスワードは8文字以上20文字以内で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
            'password_confirmation.required' => 'パスワードを入力してください',
            'password_confirmation.min'      => 'パスワードは8文字以上20文字以内で入力してください',
            'password_confirmation.max'      => 'パスワードは8文字以上20文字以内で入力してください',
        ];
    }
}
