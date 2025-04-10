<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Or add your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'original_url' => [
                'required',
                'url',
                'max:2048', // Recommended maximum URL length
                // 'starts_with:http,https', // Uncomment to enforce specific protocols
                // 'active_url', // Uncomment to verify the URL is resolvable
            ],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'original_url.required' => 'The URL field is required.',
            'original_url.url' => 'Please enter a valid URL (e.g., https://example.com).',
            'original_url.max' => 'The URL may not be longer than 2048 characters.',
       
        ];
    }


}