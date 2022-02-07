<?php

namespace App\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Settings\Company;
use Illuminate\Support\Str;

class DeleteRequest extends FormRequest
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
        $data = ucfirst(Str::singular(\Request::segment(4)));
        dd($data);
        return [
            'name' => [
                'required',
                'max:60',
                new UniqueCheck(Company::class)
            ],
            'short_name' => [
                'required',
                'max:20'
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
