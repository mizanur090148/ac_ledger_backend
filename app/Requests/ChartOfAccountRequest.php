<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\ChartOfAccount;

class ChartOfAccountRequest extends FormRequest
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
            'title' => [
                'required',
                'max:150',
                // new UniqueCheck(ChartOfAccount::class)
            ],
            'parent_id' => [
                'nullable',
                'numeric'
                // new UniqueCheck(ChartOfAccount::class)
            ],
            'type' => [
                'required'
            ]
        ];
    }
}
