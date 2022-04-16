<?php

namespace App\Requests;

use App\Repositories\Interfaces\VoucherRepositoryInterface;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueCheck;
use App\Models\Voucher;

class VoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(VoucherRepositoryInterface $repository)
    {
        $voucher = $repository->find($this->route()->parameter('id'));
        return $voucher->status ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = [
            'voucher_no' => [
                'required',
                'max:30',
                // new UniqueCheck(Voucher::class)
            ],
            'voucher_type' => [
                'required',
                'numeric'
            ],
            'company_id' => [
                'required',
                'numeric'
            ],
            'branch_id' => [
                'required',
                'numeric'
            ],
            'created_date' => [
                'required',
                'date'
            ],
            'reference' => [
                'nullable',
                'max:255'
            ],
            'credit_by' => [
                'nullable',
                'numeric'
            ],
            'currency' => [
                'required',
                function ($field, $value, Closure $failed) {
                    if (!in_array($value,['bdt','usd','euro'])){
                        $failed("Invalid currency");
                    }
                }
            ],
            'debit_by' => [
                'nullable',
                'numeric'
            ],
            'cheque_no' => [
                'nullable',
                'max:60'
            ],
            'due_date' => [
                'nullable',
                'date'
            ],
            'remarks' => [
                'nullable',
                'max:255'
            ],
            'message_to_accountant' => [
                'nullable',
                'max:255'
            ],
            'message_to_management' => [
                'nullable',
                'max:255'
            ],
            'message_for_audit' => [
                'nullable',
                'max:255'
            ]
        ];
        if ($this->voucher_type != JOURNAL) {
            $input['pay_mode'] = [
                'required',
                function ($field, $value, Closure $failed) {
                    if (!in_array($value,['cash','bank'])){
                        $failed("Invalid pay mode");
                    }
                }
            ];
        }
        if ($this->voucher_type == DEBIT_OR_PAYMENT) {
            $input['debit_to.*'] = [
                'required',
                'numeric'
            ];
        } elseif ($this->voucher_type == CREDIT_OR_RECEIVED) {
            $input['credit_to.*'] = [
                'required',
                'numeric'
            ];
        } elseif ($this->voucher_type == JOURNAL || $this->voucher_type == CONTRA) {
            $input['account_head.*'] = [
                'required',
                'numeric'
            ];
            $input['account_type.*'] = [
                'required',
                function ($field, $value, Closure $failed) {
                    if (!in_array($value,['debit','credit'])){
                        $failed("Invalid account type");
                    }
                }
            ];
        }
        if ($this->pay_mode == BANK) {
            $input['bank_name'] = [
                'required',
                'max:100'
            ];
        }
        return $input;
    }
}
