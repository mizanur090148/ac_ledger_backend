<?php

namespace App\Models;

use App\Models\Settings\Branch;
use App\Models\Settings\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'bank_name',
        'debit_by',
        'cheque_no',
        'due_date',
        'remarks',
        'message_to_accountant',
        'message_to_management',
        'message_for_audit',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $appends = [
        'voucher_type_name',
        'company_name',
        'branch_name',
        'pay_mode',
        'chart_of_account_title',
        'ac_code',
        'created_date_time',
        'total_fc_amount',
        'total_local_amount',
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return Carbon
     */
    public function getCreatedDateTimeAttribute()
    {
        return $this->created_at->format('Y-m-d h:m a');
    }
    /**
     * @return string
     */
    public function getPayModeAttribute()
    {
        return isset($this->attributes['pay_mode']) ? ucfirst($this->attributes['pay_mode']) : '';
    }
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
     * @return string
     */
    public function getBranchNameAttribute()
    {
        return $this->branch->name ?? '';
    }

    /**
     * @return string
     */
    public function getChartOfAccountTitleAttribute()
    {
        return $this->chartOfAccount->title ?? '';
    }

    /**
     * @return string
     */
    public function getAcCodeAttribute()
    {
        return $this->chartOfAccount->ac_code ?? '';
    }

    /**
     * @return mixed
     */
    public function getTotalFcAmountAttribute()
    {
        if ($this->voucher_type == 0 || $this->voucher_type == 1) {
            $result = $this->voucherDetails->where('transaction_type', 1)->sum('fc_amount');
        } else {
            $result = $this->voucherDetails->sum('fc_amount');
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getTotalLocalAmountAttribute()
    {
        if ($this->voucher_type == 0 || $this->voucher_type == 1) {
            $result = $this->voucherDetails->where('transaction_type', 1)->sum('local_amount');
        } else {
            $result = $this->voucherDetails->sum('local_amount');
        }
        return $result;
    }

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * @return BelongsTo
     */
    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class, 'credit_by');
    }

    /**
     * @return HasMany
     */
    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class)->where('transaction_type', 1);
    }
}
