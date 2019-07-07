<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exemplar;

class EmprestimoDevolutionRequest extends FormRequest
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
            'exemplar' => ['required', 'numeric', function($attr, $value, $fail){
                $exemplar = Exemplar::findOrFail($value);
                if(!$exemplar->emprestado()){
                    $fail($attr . ' não emprestado!');
                    return;
                }
            }]
        ];
    }
}
