<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Realizar autenticação do admin
     *
     * @throws ValidationException
     */
    public function autenticaAdmin(): void
    {
        if (! Auth::guard('admin')->attempt($this->only('email', 'password'), $this->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }

    /**
     * Realiza autenticação do aluno
     *
     * @throws ValidationException
     */
    public function autenticaAluno(): void
    {
        if (! Auth::guard('aluno')->attempt($this->only('email', 'password'), $this->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }
}
