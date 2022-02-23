<?php

namespace App\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\Settings\Branch;

class BranchRequest extends FormRequest
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
                new UniqueCheck(Branch::class)
            ],
            'short_form' => [
                'required',
                'max:20',
                new UniqueCheck(Branch::class)
            ],
            'address_one' => [
                'nullable',
                'max:255'
            ],
            'address_two' => [
                'nullable',
                'max:255'
            ],
            'concerned_person' => [
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
            'company_id' => [
                'required',
                'numeric'
            ]
        ];
    }
}
