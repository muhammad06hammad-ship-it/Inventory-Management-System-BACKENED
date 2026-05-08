<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'password'              => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable'],
            'role'                  => ['required', 'in:admin,staff'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'Full name is required.',
            'email.required'     => 'Email address is required.',
            'email.unique'       => 'This email address is already registered.',
            'password.required'  => 'Password is required when creating a user.',
            'password.min'       => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'role.required'      => 'Please select a role for this user.',
            'role.in'            => 'Role must be either Admin or Staff.',
        ];
    }
}
