<?php

namespace App\Models;

use App\Models\Settings\Branch;
use App\Models\Settings\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'voucher_details';

    protected $fillable = [
        'account_type',
        'account_head',
        'voucher_id',
        'debit_to',
        'account_balance',
        'description',
        'con_rate',
        'fc_amount',
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

}
