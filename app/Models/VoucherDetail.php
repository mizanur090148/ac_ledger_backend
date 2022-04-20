<?php

namespace App\Models;

use App\Models\Settings\Branch;
use App\Models\Settings\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'voucher_details';

    protected $fillable = [
        'account_type',
        'transaction_type',
        'account_head',
        'voucher_id',
        'debit_to',
        'credit_to',
        'account_balance',
        'description',
        'con_rate',
        'fc_amount',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $appends = [
        'local_amount',
        'chart_of_account_title',
        'ac_code',
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return string
     */
    public function getChartOfAccountTitleAttribute()
    {
        if ($this->debit_to) {
            $title = $this->chartOfAccount->title;
        } elseif ($this->credit_to) {
            $title = $this->chartOfAccountCredit->title;
        } else {
            $title = $this->chartOfAccountContraAndJournal->title;
        }
        return $title;
    }

    /**
     * @return string
     */
    public function getAcCodeAttribute()
    {
        if ($this->debit_to) {
            $acCode = $this->chartOfAccount->ac_code;
        } elseif ($this->credit_to) {
            $acCode = $this->chartOfAccountCredit->ac_code;
        } else {
            $acCode = $this->chartOfAccountContraAndJournal->ac_code;
        }
        return $acCode;
    }

    /**
     * @return BelongsTo
     */
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
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
     * @return float|int
     */
    public function getLocalAmountAttribute()
    {
        return $this->con_rate * $this->fc_amount;
    }

    /**
     * @return BelongsTo
     */
    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class, 'debit_to')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function chartOfAccountCredit()
    {
        return $this->belongsTo(ChartOfAccount::class, 'credit_to')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function chartOfAccountContraAndJournal()
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_head')->withDefault();
    }

}
