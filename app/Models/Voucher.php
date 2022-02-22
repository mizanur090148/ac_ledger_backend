<?php

namespace App\Models;

use App\Models\Settings\Branch;
use App\Models\Settings\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_no',
        'voucher_type',
        'company_id',
        'branch_id',
        'created_date',
        'reference',
        'pay_mode',
        'credit_by',
        'currency',
        'debit_by',
        'cheque_no',
        'due_date',
        'remarks',
        'message_to_accountant',
        'message_to_management',
        'message_for_audit',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class);
    }


}
