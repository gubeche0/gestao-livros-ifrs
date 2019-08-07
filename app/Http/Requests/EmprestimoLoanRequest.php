<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Exemplar;

class EmprestimoLoanRequest extends FormRequest
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
            'exemplar' => ['bail', 'required', 'string', 'exists:exemplares,code', function($attr, $value, $fail){
                $exemplar = Exemplar::findOrFail($value);
                if($exemplar->emprestado()){
                    $fail($attr . ' já emprestado!');
                    return;
                }
            }],
            'aluno' => ['required', 'exists:alunos,id'],
        ];
    }
}
