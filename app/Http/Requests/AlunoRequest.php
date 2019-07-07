<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            'matricula' => ['required', 'numeric', 'unique:alunos'],
            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:alunos'],
            'curso' => ['required'],
        ];
    }
}
