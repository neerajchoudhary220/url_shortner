<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:20',
            'email' => 'required|email:rfc,dns,filter|max:255|unique:users,email',
            'password'=>['required',Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'token'=>'required|exists:invitations,token'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Your name must be at least 3 characters.',
            'name.max' => 'Your name may not be greater than 20 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address may not be greater than 255 characters.',
            'email.unique' => 'This email is already registered. Please login or use a different email.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.mixed' => 'Password must contain both uppercase and lowercase letters.',
            'password.numbers' => 'Password must contain at least one number.',
            'password.symbols' => 'Password must contain at least one special character.',
            'password.uncompromised' => 'This password has appeared in a data breach. Please choose a different password.',
            'token.required'=>'Token is required',
            'token.exists'=>'Invalid token',

            
        ];
    }
}
