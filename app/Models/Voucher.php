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

    protected $appends = [
        'amount',
        'voucher_type_name',
        'company_name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return mixed
     */
    public function getVoucherTypeNameAttribute()
    {
        return VOUCHER_TYPES[$this->attributes['voucher_type']];
    }

    /**
     * @return string
     */
    public function getCompanyNameAttribute()
    {
        return $this->company->name ?? '';
    }

    /**
     * @return mixed
     */
    public function getAmountAttribute()
    {
        if ($this->voucher_type == 0 || $this->voucher_type == 1) {
            $result = $this->voucherDetails->where('transaction_type', 1)->sum('local_amount');
        } else {
            $result = $this->voucherDetails->sum('local_amount');
        }
        return $result;
    }

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
