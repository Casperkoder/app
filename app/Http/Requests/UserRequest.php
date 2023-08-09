<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|min:3|max:50',
            'user_email' => 'required|email'
        ];
    }
    public function messages()
    {
        return  [
            'required' => ':attribute zorunludur.',
            'min' => ':attribute değer 3 karakter fazla olmalıdır.',
            'max' => ':attribute değerin dışında.',
            'email' => ':attribute mail formatında olmalıdır.'
        ];
    }
    public function attributes()
    {
        return  [
            'user_name' => 'Kullanıcı adı',
            'user_email' => 'Kullanıcı mail'
        ];
    }
}
