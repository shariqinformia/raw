<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email is already registered.',
            'gender.required' => 'Please select a gender.',
            'birth_date.before' => 'Birth date must be in the past.',
        ];
    }

}
