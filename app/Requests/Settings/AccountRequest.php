<?php

namespace App\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\Settings\Account;

class AccountRequest extends FormRequest
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
            'ac_name' => [
                'required',
                'max:60',
                new UniqueCheck(Account::class)
            ],
            'ac_code' => [
                'required',
                'max:50',
                new UniqueCheck(Account::class)
            ],
            'balance_type' => [
                'required'
            ],
            'opening_balance' => [
                'required',
                'numeric'
            ]
        ];
    }
}
