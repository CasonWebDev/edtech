<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarAlunoRequest extends FormRequest
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
            'nome' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'unique:App\Models\User,email',
                Rule::unique('App\Models\Aluno', 'email')->ignore($this->id)
            ],
        ];
    }
}
