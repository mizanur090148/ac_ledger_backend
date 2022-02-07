<?php

namespace App\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class FactoryLogoRequest extends FormRequest
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
     * Get the validation messages that apply to the erroneous request.
     *
     * @return bool
     */
    public function messages()
    {
        return [
            'logo.required' => 'Company logo is required.',
            'logo.mimes'    => 'Company logo is required.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => [
                'required',
                'image',
                'max:1024',
                'mimes:jpeg,png',
            ]
        ];
    }
}
