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
            ],
            'ac_code' => [
                'required'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $acCodeFirstPart = substr($this->ac_code, 0, 2);
        $result = ChartOfAccount::where('type', $this->type)
            ->where('ac_code', 'like', '%'.$acCodeFirstPart.'%')
            ->orderBy('ac_code', 'desc')
            ->first();
        if ($result) {
            $acCodeLastPart = (int) substr($result->ac_code, 3, 10) + 1;
            $acCode = $acCodeFirstPart . '-' . str_pad($acCodeLastPart, 4, '0', STR_PAD_LEFT);
            $this->merge([
                'ac_code' => $acCode
            ]);
        }
    }
}
