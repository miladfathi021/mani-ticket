<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => ['bail', 'required', 'regex:/^(0|0098|\+98)9(0[1-5]|[1 3]\d|2[0-2]|98)\d{7}$/'],
            'password' => 'bail|required|min:6|max:255'
        ];
    }
}
