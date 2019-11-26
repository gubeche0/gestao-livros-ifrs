<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password' => ['required', new CurrentPasswordCheckRule],
            'password' => ['required', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => __('senha atual'),
        ];
    }
}
