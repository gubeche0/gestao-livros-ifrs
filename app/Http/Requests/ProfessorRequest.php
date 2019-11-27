<?php


namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfessorRequest extends FormRequest
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
        $user = User::find($request->get('id'));
        if($user == null){
            return [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
            ];
        }

        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore($user->id)],
        ];
    }
}
