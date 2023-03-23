<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
