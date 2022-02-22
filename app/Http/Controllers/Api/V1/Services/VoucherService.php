<?php

namespace App\Http\Controllers\Api\V1\Services;

class VoucherService
{
    public function processVoucherInput($request)
    {
        $voucherDetails = [];
        foreach ($request->account_balance as $key => $acBalance) {
            $voucherDetails[$key]['debit_to'] = $request->debit_to[$key] ?? null;
            $voucherDetails[$key]['credit_to'] = $request->credit_to[$key] ?? null;
            $voucherDetails[$key]['account_type'] = $request->account_type[$key] ?? null;
            $voucherDetails[$key]['account_head'] = $request->account_head[$key] ?? null;
            $voucherDetails[$key]['account_balance'] = $acBalance;
            $voucherDetails[$key]['description'] = $request->description[$key];
            $voucherDetails[$key]['con_rate'] = $request->con_rate[$key];
            $voucherDetails[$key]['fc_amount'] = $request->fc_amount[$key];
        }
        return $voucherDetails;
    }
}