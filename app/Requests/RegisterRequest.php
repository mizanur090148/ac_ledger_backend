<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\User;

class RegisterRequest extends FormRequest
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
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'mobile_no.required' => 'Mobile no is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'confirmed_password.required' => 'Confirmed password is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'max:30'
            ],
            'last_name' => [
                'required',
                'max:30'
            ],
            'mobile_no' => [
                'required',
                'max:22',
            ],
            'email' => [
                'required',
                'email',
                'max:30',
                new UniqueCheck(User::class)
            ],
            'role_id'=> [
                'nullable', 'numeric'
            ],
            'password'=> [
                'required',
                'min:6',
                'same:confirmed_password'
            ],
           /* 'confirmed_password'=> [
                'required'
            ]*/
        ];
    }
}
