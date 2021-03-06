<?php

namespace App\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\Settings\Company;

class CompanyRequest extends FormRequest
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
            'name' => [
                'required',
                'max:60',
                new UniqueCheck(Company::class)
            ],
            'short_name' => [
                'required',
                'max:20',
                new UniqueCheck(Company::class)
            ],
            'address_one' => [
                'nullable',
                'max:255'
            ],
            'address_two' => [
                'nullable',
                'max:255'
            ],
            'email' => [
                'required',
                'max:40'
            ],
            'contact_no' => [
                'required',
                'max:20'
            ],
        ];
    }
}
