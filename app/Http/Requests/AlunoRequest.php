<?php

namespace App\Http\Requests;

use App\Aluno;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        $aluno = Aluno::where('email', $request->email)->first();
        if($aluno == null){
            return [
                'matricula' => ['required', 'numeric', 'unique:alunos'],
                'nome' => ['required'],
                'email' => ['required', 'email', 'unique:alunos'],
                'curso' => ['required', 'exists:cursos,id'],
            ];
        }else{
            return [
                'matricula' => ['required', 'numeric', Rule::unique((new Aluno)->getTable())->ignore($aluno->id)],
                'nome' => ['required'],
                'email' => ['required', 'email', Rule::unique((new Aluno)->getTable())->ignore($aluno->id)],
                'curso' => ['required', 'exists:cursos,id'],
            ];
        }
    }
}
