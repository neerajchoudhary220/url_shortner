<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules =
        [
            'name' => 'required|min:3|max:20',
            'email' => [
                'required',
                'email:rfc,dns,filter',
                'max:255',
                Rule::unique('users', 'email'), // Correct way to check email doesn't exist
            ],
        ];
        if(auth()->user()->hasRole('SuperAdmin')){
            $rules['company_id'] = 'required|exists:companies,id';
        }
        return $rules;
        // 'company_id'=>auth()->user()->hasRole('SuperAdmin')?'required|exists:'

    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already invited.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name may not be greater than 20 characters.',
            'company_id.required'=>'Company id is required',
            'company_id.exists'=>'Invalid given company id'
        ];
    }
}